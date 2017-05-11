<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qrcode extends CI_Controller {
	/**
	* Index page for QRCode controller
	*/
	public function index($user_id=""){
		$data["qr"] = $user_id;
	
		$this->load->view('qrcode',$data);
	}
}

