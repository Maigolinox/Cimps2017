<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Descargas extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('order_model');
		$this->load->library('grocery_CRUD');
		$this->load->helper('language');
		$this->load->library('session');
		$language = $this->session->userdata('language');
			
		if(!$language)
				$language = "english";
				
			$this->lang->load('cimps', $language);
			
		$this->load->library('ion_auth');
	}
	
	public function index(){

		if (!$this->ion_auth->logged_in())
        {
            redirect('auth');
        }
		
		if($this->ion_auth->in_group(array(1,10))){
			$datos['empresarial'] = true;
		}else{
			$datos['empresarial'] = false;
		}
	
		$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => false));
		$this->load->view('descargas', $datos);
		$this->load->view('footer');
	}
	
	public function constancia(){
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth');
        }
	
		$user = $this->ion_auth->user()->row();
		
		//echo "si entra usuarios ".$user->name;
		
		if(!$this->order_model->paid($user->id)){
			redirect('descargas');
		}
		
		$this->load->library("image_moo");
		
		$this->image_moo
		->load('/home1/ingsofti/public_html/cimps/registration_system/assets/img/CIMPS2016cc.jpg')
		->make_watermark_text($user->name, "/home1/ingsofti/public_html/cimps/registration_system/assets/fonts/timesbd.ttf", 40, "#600314")
		->watermark(5)
		->save_dynamic();
		#echo $_SERVER['DOCUMENT_ROOT'];
	}
	
	public function constancia_(){
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth');
        }
	
		$user = $this->ion_auth->user()->row();
		
		//echo "si entra usuarios ".$user->name;
		
		if(!$this->order_model->paid($user->id)){
			redirect('descargas');
		}
		
		$this->load->library("image_moo");
		
		$this->image_moo
		->load('/home1/ingsofti/public_html/cimps/registration_system/assets/img/CIMPS2016cc.jpg')
		->make_watermark_text($user->name, "/home1/ingsofti/public_html/cimps/registration_system/assets/fonts/timesbd.ttf", 40, "#600314")
		->watermark(5)
		->save_dynamic();
	}
	
	public function constanciaPDF(){
	
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth');
        }
	
		$user = $this->ion_auth->user()->row();
		
		if(!$this->order_model->paid($user->id)){
			redirect('descargas');
		}
		
		$this->load->library("image_moo");
		
		$this->image_moo
		->load('/home1/ingsofti/public_html/cimps/registration_system/assets/img/CIMPS2016cc.jpg')
		->make_watermark_text($user->name, "/home1/ingsofti/public_html/cimps/registration_system/assets/fonts/timesbd.ttf", 32, "#600314")
		->watermark(5)
		->save("/home1/ingsofti/public_html/cimps/registration_system/assets/img/c".$user->id."2016.jpg");
		
		$this->load->library('PDF');
		$program = $this->load->view('constancia', array('id' => $user->id), true);
		$this->pdf->generatePDF2($program);
	}
	
	public function presentacionesAcademicas(){
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth');
        }
		// echo "presentacionesAcademicas";
		$user = $this->ion_auth->user()->row();
		
		//echo "si entra usuarios ".$user->name;
		
		if(!$this->order_model->paid($user->id)){
			redirect('descargas');
		}
		
		
		$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => false));
		$this->load->view('academicas');
		$this->load->view('footer');
		
		//echo "si entra";
		
	}
	
	public function memoriasCongreso(){
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth');
        }
	
		// echo "memoriasCongreso";
		$user = $this->ion_auth->user()->row();
		// echo "se obtuvo usuario";
		if(!$this->order_model->paid($user->id)){
			redirect('descargas');
			//echo "no esta pagado";
		}else{
			//echo "pagado";
		}

		if (!$this->ion_auth->in_group(array(1,2,10)))
		{
			redirect('descargas');
		}
		
		// echo "si entra";
		
		$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => false));
		$this->load->view('memorias');
		$this->load->view('footer');
	}
	
	function presentacionesEmpresariales(){
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth');
        }
		// echo "presentacionesEmpresariales";
		$user = $this->ion_auth->user()->row();
		
		if(!$this->order_model->paid($user->id)){
			redirect('descargas');
		}
	
		if (!$this->ion_auth->in_group(array(1,10)))
		{
			redirect('descargas');
		}
		
		
		$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => false));
		$this->load->view('empresariales');
		$this->load->view('footer');
		//echo "si entra";
	}
	
	public function d($type, $name){
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth');
        }
		$this->load->helper('download');

		if($type=="academica"){
		
			$user = $this->ion_auth->user()->row();

			if(!$this->order_model->paid($user->id)){
				redirect('descargas');
			}
			
		}else if($type=="empresarial"){
		
			$user = $this->ion_auth->user()->row();
		
			if(!$this->order_model->paid($user->id)){
				redirect('descargas');
			}
		
			if (!$this->ion_auth->in_group(array(1,10)))
			{
				redirect('descargas');
			}
			
		}else if($type=="memoria"){
		
			$user = $this->ion_auth->user()->row();
		
			if(!$this->order_model->paid($user->id)){
				redirect('descargas');
			}
		
			if (!$this->ion_auth->in_group(array(1,2,10)))
			{
				redirect('descargas');
			}
			
		}else{
			redirect('descargas');
		}
		// $data = file_get_contents("/registration_system/assets/downloads/".$type."/".$name);
		if(file_exists ("/home1/ingsofti/public_html/cimps/registration_system/assets/downloads/".$type."/".$name)){
			$data = file_get_contents("/home1/ingsofti/public_html/cimps/registration_system/assets/downloads/".$type."/".$name);
		
			force_download($name, $data);
		}else{
			redirect('descargas');
		}
	}
	
}