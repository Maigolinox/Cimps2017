<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function create_order($user_id){
    
        $query = $this->db->query("SELECT * FROM `order` WHERE users_id=".$user_id."");
        
		if ($query->num_rows() > 0)
		{
		   return $query->row()->id;
		}else{
            $this->db->set('users_id', $user_id);
            $this->db->set('date', 'CURRENT_DATE()', FALSE);
            
            $this->db->insert('order');
            return $this->db->insert_id();
        }
    
		
	}
	
	public function get_order($users_id){
		$query = $this->db->query("SELECT * FROM `order` WHERE users_id=".intval($users_id)."");
		if ($query->num_rows() > 0)
		{
		   return $query->row();
		}
		
		return false;
	}
	
	public function update_order($type_payment, $image, $bank, $reference, $date, $tax, $id ){
	
		$data = array(
			'type_payment' => $type_payment,
			'bank' => $bank,
			'reference' => $reference,
			'date' => $date,
			'tax_number' => $tax,
		);
		
		if(!empty($image)){
			$data['image'] = $image;
		}
		
		$this->db->where('id', $id);
		$this->db->update('order', $data);
	}
	
	public function set_accepted($order_id, $accepted)
	{
		$data = array(
			'accepted' => $accepted,
		);
		try
		{
			$this->db->where('id', $order_id);
			$this->db->update('order', $data);
		}
		catch (Exception $e)
		{
			return false;
		}		
		return true;
	}
	
	public function set_discount($order_id, $moneda, $valor)
	{
		if ($moneda == 0)
			$campo = 'discount';
		else
			$campo = 'discount_euros';
		
		$data = array(
				$campo => $valor,
		);
		
		$this->db->where('id', $order_id);
		$this->db->update('order', $data);
	}
	
	public function get_costs($order_id){
		$query = $this->db->query('SELECT (us.quantity * s.cost) as total, (us.quantity * s.euro) as euro, s.name, s.id, us.quantity FROM `order` o, users_has_services us, services s WHERE o.id = "'.$order_id.'" AND us.order_id = o.id AND us.services_id = s.id');
		return $query->result();
	}
	
	public function get_discounts($order_id){
                $id = intval($order_id);
		$query = $this->db->query("select discount, discount_euros from `order` where id={$id}");
		return $query->row();
	}
	
	public function get_total_costs($user_id){
		if (!($order_id = $this->get_order($user_id)->id))
			return false;
		$query = $this->db->query('SELECT SUM(us.quantity * s.cost) as total_pesos, SUM(us.quantity * s.euro) as total_euros FROM `order` o, users_has_services us, services s WHERE o.id = "'.$order_id.'" AND us.order_id = o.id AND us.services_id = s.id');
		return $query->row();
	}
	
	public function update_remaining_data($organization, $adress, $locality, $postal_code, $country, $phone_number, $tax, $id){
	    $data = array(
			'organization' => $organization,
			'adress' => $adress,
			'locality' => $locality,
			'postal_code' => $postal_code,
			'country' => $country,
			'phone_number' => $phone_number,
			'tax_number' => $tax,
		);
		
		
		$this->db->where('id', $id);
		$this->db->update('order', $data); 
	}
	
	public function delete_services($order_id){
		$this->db->delete('users_has_services', array('order_id' => $order_id)); 
	}
	
	public function add_to_group($group_id, $user_id){
		$data = array(
		   'user_id' => $user_id,
		   'group_id' => $group_id,
		);
		
		$this->db->insert('users_groups', $data); 
	}
	
	public function paid($user_id){
		$query = $this->db->query("select accepted from `order` where users_id={$user_id}");
		$user = $query->row();
		
		if($user->accepted){
			return true;
		}
		
		return false;
	}
	
	//SELECT (us.quantity * s.cost) as total, (us.quantity * s.euro) as euro  FROM  `order` o, users_has_services us, services s WHERE o.id = "7" AND us.order_id = o.id AND us.services_id = s.id
	
}