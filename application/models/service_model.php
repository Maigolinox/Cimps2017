<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_services(){
		$query = $this->db->get('services');
		return $query->result();
	}
	
	/*SELECT * 
		FROM services AS s, groups AS g, groups_has_services AS gs
		WHERE gs.groups_id = g.id
		AND gs.services_id = s.id
		AND g.name =  "Autor"*/
	public function get_services_by_group($group){
		$query = $this->db->query('SELECT s.* FROM services AS s, groups AS g, groups_has_services AS gs WHERE gs.groups_id = g.id AND gs.services_id = s.id AND g.name =  '.$this->db->escape($group).'');
		
		return $query->result();
	}
	
	public function get_services_by_group_id($group_id){
		$query = $this->db->query('SELECT s.* FROM services AS s, groups AS g, groups_has_services AS gs WHERE gs.groups_id = g.id AND gs.services_id = s.id AND g.id =  '.$this->db->escape($group_id).'');
		
		return $query->result();
	}
	
	public function add_user_service( $service_id, $quantity,$order_id, $total=0){
		$data = array(
		   'services_id' => $service_id ,
		   'quantity' => $quantity ,
		   'total' =>  $total ,
		   'order_id' => $order_id ,
		);
		
		$this->db->insert('users_has_services', $data);
	}

}