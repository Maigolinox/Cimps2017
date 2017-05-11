<?php defined('BASEPATH') OR exit('No direct script access allowed');


class ProgramWork extends CI_Controller {
	
	private $horario = array('08:00:00' => '08:00', 
							  '09:00:00' => '09:00',
							  '10:00:00' => '10:00',
							  '10:50:00' => '10:50',
							  '11:00:00' => '11:00',
							  '11:10:00' => '11:10',
							  '11:20:00' => '11:20',
							  '11:30:00' => '11:30',
							  '12:00:00' => '12:00',
							  '12:05:00' => '12:05',
							  '12:10:00' => '12:10',
							  '12:20:00' => '12:20',
							  '12:30:00' => '12:30',
							  '13:00:00' => '13:00',
							  '13:20:00' => '13:20',
							  '13:30:00' => '13:30',
							  '14:00:00' => '14:00',
							  '14:30:00' => '14:30',
							  '15:00:00' => '15:00',
							  '15:40:00' => '15:40',
							  '16:00:00' => '16:00',
							  '16:20:00' => '16:20',
							  '16:30:00' => '16:30',
							  '16:50:00' => '16:50',
							  '17:00:00' => '17:00',
							  '17:40:00' => '17:40',
							  '18:00:00' => '18:00',
							  '19:00:00' => '19:00',
							  '20:00:00' => '20:00',
							  '23:00:00' => '23:00',
							  );
	
	function __construct()
	{
		parent::__construct();
	
		$this->load->helper('url');
		$this->load->model('order_model');
		$this->load->library('grocery_CRUD');
		$this->load->library('ion_auth');
    }
	
	function index(){
		$this->load->model('program2_model');
		$eventos = $this->program2_model->get_program();
		
		foreach($eventos as $evento){
			if($evento->id_lugar)
				$evento->lugar = $this->program2_model->get_lugar($evento->id_lugar)->nombre;
		}
		
		$data['eventos'] = $eventos;
		$data['descargar'] = True;
		$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => false));
		$this->load->view('programWork', $data);
		$this->load->view('footer');
	}
	
	function admin(){
		if (!$this->ion_auth->logged_in()  ||  !$this->ion_auth->is_admin())
			redirect('auth');
			
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
		
			$crud->set_theme('flexigrid');
			$crud->set_table('programaWork');
			$crud->set_subject('Programa Workshop');
			
			/*$crud->fields('tittle', 'name', 'email', 'city', 'country', 'afiliation_name', 'afiliation_adress',
					'gaffete', 'grupo', 'paper_id1', 'title1', 'paper_id2', 'title2');*/
			
			/*$crud->display_as('tittle','Title')
				->display_as('grupo', 'Group')
				->display_as('paper_id1', 'Paper 1 ID')
				->display_as('title1', 'Paper 1 Title')
				->display_as('paper_id2', 'Paper 2 ID')
				->display_as('title2', 'Paper 2 Title');*/
			$crud->field_type('hora_inicio','dropdown', $this->horario);
			$crud->field_type('hora_fin','dropdown', $this->horario);
			$crud->display_as('id_lugar','Lugar');
			$crud->unset_fields('id');
			$crud->field_type('descripcion', 'text');
			$crud->set_relation('id_lugar','lugar','nombre');
			$crud->order_by('dia, hora_inicio','asc');
			$output = $crud->render();
				
			$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => true));

			$this->load->view('admin', $output);

			$this->load->view('footer');
				
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function download(){
		$this->load->model('program2_model');
		$eventos = $this->program2_model->get_program();
		
		foreach($eventos as $evento){
			if($evento->id_lugar)
				$evento->lugar = $this->program2_model->get_lugar($evento->id_lugar)->nombre;
		}
		
		$data['eventos'] = $eventos;
		
		//$this->load->helper('download');
		$this->load->library('PDF');
		$program = $this->load->view('programWork', $data, true);
		$this->pdf->generatePDF($program);
		//force_download("Program_CIMPS_2016.pdf", $program);
	}
}