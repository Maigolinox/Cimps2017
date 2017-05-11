<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_export_data(){
		
		return $this->db->get('info');
	}
	
	public function add_recovery($name, $email, $affiliation, $group, $total ){
		$data = array(
			'name' => $name,
			'email' => $email,
			'institute' => $affiliation,
			'group' => $group,
			'total' => $total,
		);
		
		$this->db->insert('recovery', $data); 
	}
		
}