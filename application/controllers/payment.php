<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	private $payment_type = array('paypal' => 'By PayPal', 'deposit' => 'By deposit', 'transfer' => 'By bank transfer');
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$language = $this->session->userdata('language');
		
		if(!$language)
			$language = "english";
			
		$this->lang->load('cimps', $language);
		$this->load->helper('language');
		
	}
	
	function index($user_id = ""){
		$this->load->helper(array('form', 'url'));
		$this->load->library('ion_auth');
		$this->load->model('order_model');
		$this->load->library('session');
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth');
		}
		if ($user_id != ""  &&  $this->ion_auth->is_admin())
		{
			$admin = $this->ion_auth->user()->row();
			$data['admin'] = true;
			$user = $this->ion_auth->user($user_id)->row();
			$data['crud_user_id'] = $user_id;
			$data['url_crud_id'] = "/".$user_id;
		}
		else
		{
			$data['admin'] = false;
			$user = $this->ion_auth->user()->row();
			$data['url_crud_id'] = "";
		}
		
		$order = $this->order_model->get_order($user->id);
		$data['payment_type'] = $this->payment_type;
		$data['user'] = $user;
		$data['suc'] =  $this->session->flashdata('succesfull');
		
		
		if(!empty($order->date)){
			$order->date = date('m/d/Y', strtotime($order->date));
		}
		
		$data['order'] = $order;
		$data['costs'] = $this->order_model->get_costs($order->id);
        $data['discounts'] = $this->order_model->get_discounts($order->id);
		
		
		if ($this->ion_auth->is_admin())
			$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => true));
		else
			$this->load->view('header', array('user' => $user));
		$this->load->view('payment', $data);
		$this->load->view('footer');
	}
	
	function add($user_id = ""){
	    $this->load->model('order_model');
	    $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		
		if ($user_id != ""  &&  $this->ion_auth->is_admin())
		{
			$admin = $this->ion_auth->user()->row();
			$data['admin'] = true;
			$user = $this->ion_auth->user($user_id)->row();
			$data['crud_user_id'] = $user_id;
			$data['url_crud_id'] = "/".$user_id;
		}
		else
		{
			$data['admin'] = false;
			$user = $this->ion_auth->user()->row();
			$data['url_crud_id'] = "";
		}
		


		$order = $this->order_model->get_order($user->id);
		$this->form_validation->set_rules('payment_type', 'Choose one of three ways for payment', 'required');
		
                $pay_type = $this->input->post("payment_type");
                if ($pay_type != "paypal"){
            
 $this->form_validation->set_rules('date', 'Date', 'required|callback_valid_date');

		    $this->form_validation->set_rules('bank', 'Bank', 'required');

		//if(!$this->input->post("tax")){
		//		$this->form_validation->set_rules('organization', 'Organization', 'required');
		//		$this->form_validation->set_rules('adress', 'Address', 'required');
		///		$this->form_validation->set_rules('locality', 'Locality', 'required');
			//	$this->form_validation->set_rules('postal_code', 'Postal Code', 'required');
			//	$this->form_validation->set_rules('country', 'Country', 'required');
			//	$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
			//	$this->form_validation->set_rules('tax_number', 'Tax Number', 'required');
		//}
		}
		
		if ($this->form_validation->run() == FALSE )
		{
				$data['payment_type'] = $this->payment_type;
				$data['user'] = $user;
				$data['order'] = $order;
				$data['costs'] = $this->order_model->get_costs($order->id);
				$data['payment_type'] = $this->payment_type;
				
				if ($this->ion_auth->is_admin())
					$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => true));
				else
					$this->load->view('header', array('user' => $user));
				$this->load->view('payment', $data);
				$this->load->view('footer');
		}
		else
		{
			$payment_type =  $this->input->post("payment_type");
			$date = $this->input->post("date");
			$date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
			$bank = $this->input->post("bank");
			$reference = $this->input->post("reference");
			
			//Factura
			$organization = $this->input->post("organization");
			$adress = $this->input->post("adress");
			$locality = $this->input->post("locality");
			$postal_code = $this->input->post("postal_code");
			$country = $this->input->post("country");
			$phone_number = $this->input->post("phone_number");
			$tax = $this->input->post("tax_number");
			
			$config['upload_path'] = './assets/payments/';
			$config['allowed_types'] = 'gif|jpg|png|pdf|ttf|jpeg';
			$config['max_size']	= '2000';
			$config['encrypt_name']	= true;
			
			$this->load->library('upload', $config);
			if($_FILES['proof_payment']['name']!="No se eligió archivo"){
				
				if ( ! $this->upload->do_upload('proof_payment'))
				{
					$data['error'] = $this->upload->display_errors();
					$data['payment_type'] = $this->payment_type;
					$data['user'] = $user;
					$data['order'] = $order;
					$data['costs'] = $this->order_model->get_costs($order->id);
					$data['payment_type'] = $this->payment_type;
					
					if ($this->ion_auth->is_admin())
						$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => true));
					else
						$this->load->view('header', array('user' => $user));
					$this->load->view('payment', $data);
					$this->load->view('footer');
				}
				else
				{
					$file = $this->upload->data();
					// enviar email de confirmacion de que se subio un archivo por parte del usuario
					$this->sendEmail($this->ion_auth->user()->row(), $file);
					
					$this->order_model->update_order($payment_type, $file['file_name'], $bank, $reference, $date, $tax, $order->id);
					if(!$this->input->post("tax", 1)){
						$this->order_model->update_remaining_data($organization, $adress, $locality, $postal_code, $country, $phone_number,$tax, $order->id);
					}
					
					$this->load->library('session');
					$this->session->set_flashdata('succesfull', 'Payment successfully added.');
					if ($data['admin'])
						$data = array('upload_data' => $this->upload->data(),
								'admin' => $data['admin'], 'crud_user_id' => $data['crud_user_id']);
					else
						$data = array('upload_data' => $this->upload->data(),
								'admin' => $data['admin']);
					if ($data['admin'])
						redirect("payment/index/".$data['crud_user_id']);
					else
						redirect("payment");
				}
			}else{
					$file = $this->upload->data();
					$this->order_model->update_order($payment_type, $file['file_name'], $bank, $reference, $date, $tax, $order->id);
					
					if(!$this->input->post("tax", 1)){
						$this->order_model->update_remaining_data($organization, $adress, $locality, $postal_code, $country, $phone_number, $tax, $order->id);
					}
					
					$this->load->library('session');
					$this->session->set_flashdata('succesfull', 'Update succesfull.');
					$data = array('upload_data' => $this->upload->data(), 
									'admin' => $data['admin'], 'crud_user_id' => $data['crud_user_id']);
					if ($data['admin'])
						redirect("payment/index/".$data['crud_user_id']);
					else
						redirect("payment");
			}
		}
	}
	
	public function valid_date($date){
		$date = date_parse($date);
		if (checkdate($date["month"], $date["day"], $date["year"])){
			return true;
		}else{
		    $this->form_validation->set_message('valid_date', 'Invalid date.');
			return false;
		}
	}
	function sendEmail($user, $file){
			$this->load->library('PostageApp');

			// Datos del archivo cargado
			$path = $file['full_path'];
			$fileName = $file['orig_name'];
			$fileType = $file['file_type']; // image/jpeg o application/pdf
			$file_name = $file['file_name']; // nombre codificado dentro del servidor

			// variables de usuario
			$email = $user->username; // email
			$name = $user->name; 
			$afiliation_name = $user->afiliation_name; // Ejmp: CIMAT - guanajuato
			$country = $user->country;
			$city = $user->city;

			// Ej. link : http://cimps.cimat.mx/registro2/assets/payments/d9c729ebebb67099e22ca0114446a6d4.png
			$link = 'http://cimps.cimat.mx/registro/assets/payments/'.$file_name;

			// se asigna los datos a la vista
			$message =  $this->load->view('confirm', array(
				"email" => $email,
				"name" => $name,
				"afiliation_name" => $afiliation_name,
				"country" => $country,
				"city" => $city,
				"fileName" => $fileName,
				"link" => $link,
			), true);

			$this->load->library('PostageApp');
            $this->postageapp->from('conferencecimps@cimat.mx');
            $this->postageapp->to("conferencecimps@cimat.mx");
            $this->postageapp->subject('Registro de comprobante de pago de: '.$name);
			
			// $this->postageapp->attach($path); // enviar imagen por correo. (rquiere actualizar plan de postageapp)

            $this->postageapp->message(
               array('text/html' => $message
            ));

			$this->postageapp->send();
	}
}
