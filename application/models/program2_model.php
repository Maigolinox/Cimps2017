<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program2_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_program(){
		$query = $this->db->query("SELECT * FROM programaWork ORDER BY dia, hora_inicio, id");
		
		return $query->result();
	}
	
	function get_lugar($id_lugar){
		$query = $this->db->query("SELECT nombre FROM lugar WHERE id=".$id_lugar);
		
		return $query->row();
	}
}