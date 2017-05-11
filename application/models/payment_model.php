<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_order($users_id){
		$query = $this->db->query("SELECT * FROM `order` WHERE users_id=".$users_id."");
		if ($query->num_rows() > 0)
		{
		   return $query->row();
		}
		
		return false;
	}
}
