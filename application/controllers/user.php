<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User extends CI_Controller {

        private $tittle_options = array(
                  'Mr.'  => 'Mr.(name)',
                  'Miss.'    => 'Miss.(name)',
                  'Dr.'   => 'Dr.(name)',
                  'Prof.' => 'Prof.(name)',
                  'Eng.' => 'Eng.(name)',
                  'Alum.' => 'Alum.(name)',
                  'Comp.' => 'Comp.(name)'
                );

        private $venue_options = array(
            '0' => 'Other',
           '1' => 'Instituto Nacional De Estadística Y Geografía',
           '2' => 'Instituto Tecnológico De Aguascalientes',
           '3' => 'Instituto Tecnológico De Orizaba',
           '4' => 'Instituto Tecnológico De Zacatecas',
           '5' => 'Universidad Autónoma De Yucatán',
           '6' => 'Universidad Católica Del Norte',
           '7' => 'Universidad De Atacama',
           '8' => 'Universidad Politécnica De Aguascalientes',
           '9' => 'Universidad Politécnica De Zacatecas',
           '10' => 'Universidad Veracruzana',
           '11' => 'Centro De Bachillerato Tecnológico Industrial Y De Servicios No.168',
           '12' => 'Centro De Investigación En Matemáticas, A.C. Unidad Aguascalientes',
           '13' => 'Centro De Investigación En Matemáticas, A.C. Unidad Guanajuato',
           '14' => 'Centro De Investigación En Matemáticas, A.C. Unidad Zacatecas'                 
           
                );

        private $size_options = array(
                  'S'  => 'S',
                  'M'  => 'M',
                  'L'  => 'L',
                  'XL'  => 'XL',
                  'XXL'  => 'XXL'
                );
        
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
		
		function es(){
			$this->load->helper('url');
			$this->session->set_userdata('language', "spanish");
			$this->load->library('user_agent');
			if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}else{
				redirect("http://cimps.cimat.mx/registration_system/");
			}
			//redirect($ref, 'location'); 
		}
		
		function en(){
			$this->load->helper('url');
			$this->session->set_userdata('language', "english");
			$this->load->library('user_agent');
			if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}else{
				redirect("http://cimps.cimat.mx/registration_system/");
			}
		}
		
        public function index()
        {
            $this->load->helper(array('form', 'url'));
            //$this->output->enable_profiler(TRUE);
            $this->load->model('Service_model');
            $this->load->library('ion_auth');
            
            if ($this->ion_auth->logged_in())
            {
                redirect('user/information');
            }
             
			$groups = $this->ion_auth->groups()->result();
			
			$goups_options = array();
			foreach ($groups as $group){
					if($group->id != "1"){
						$goups_options[$group->id] = $group->name;
					}
			}
			
			$services_autor = $this->Service_model->get_services_by_group_id(2);
			$services = $this->Service_model->get_services();
			
			$data = array('services' => $services,'services_autor'=> $services_autor, 'tittle' => $this->tittle_options, 'groups' =>  $goups_options, 'venues' => $this->venue_options, 'sizes' => $this->size_options);
			
			$this->load->view('header');
            //$this->load->view('baja');
			$this->load->view('principal', $data);
			$this->load->view('footer');
                
                
        }
        
        public function services_ajax($group){
           $this->load->model('Service_model');
           
           $services = $this->Service_model->get_services_by_group_id($group);
           //var_dump($services);
           $data = array('services' => $services, 'group' => $group);
                
           $this->load->view('ajax/services', $data);
        }
        
        public function register($admin = ""){
            $this->load->library('form_validation');
            $this->load->helper(array('form', 'url'));
            $this->load->library('ion_auth');
            $this->load->model('Service_model');
            $this->load->model('order_model');
        
            if ($this->ion_auth->logged_in()  &&  ($admin == ""  ||  !$this->ion_auth->is_admin()))
            {
                redirect('user/information');
            }
            if ($admin == "admin"  &&  $this->ion_auth->is_admin())
            {
            	$is_admin = true;
            	$user_admin = $this->ion_auth->user()->row();
            }
            else
            	$is_admin = false;
                
                
            $groups = $this->ion_auth->groups()->result();
            $code = $this->ion_auth->access_code(1);
            
            $goups_options = array();
            foreach ($groups as $group){
                    if($group->id != "1"){
                        $goups_options[$group->id] = $group->name;
                    }
            }
            
            $this->form_validation->set_rules('tittle', 'Tittle', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            
            $id_grupo = $this->input->post("registre_porfile");
            $id_venue = $this->input->post("reg_venue");
            $access_code = $this->input->post("access_code");
            //$af_name = $this->input->post("afiliation_name");
            
            if(empty($id_grupo)) {
                $id_grupo = 2;          //Author
            } else if($id_grupo==4) { //$af_name=='I.T. Aguascalientes'){ //Student
                $this->form_validation->set_rules('shirt_size', 'Shirt Size', 'required');

                if ($id_venue==1)    //del ITA?
                   $this->form_validation->set_rules('control_num', 'Control Number', 'required|callback_control_num_check');

            } else if($id_grupo==2) {   //Author
                $this->form_validation->set_rules('paper_id1', 'Paper Id (at least one)', 'required');
                $this->form_validation->set_rules('paper_title1', 'Paper Title (at least one)', 'required');
            } else if($id_grupo==6||$id_grupo==7||$id_grupo==8||$id_grupo==9||$id_grupo==10) { //No pagan
               $this->form_validation->set_rules('access_code', 'Access Code', 'required');
            }
            
            //afiliation_name
            //afiliation_address
            $this->form_validation->set_rules('registre_porfile', 'Registre Porfile', 'required');
            $this->form_validation->set_rules('reg_venue', 'Afiliation', 'required');
            
            $services = $this->Service_model->get_services();
            $services_a = $this->Service_model->get_services_by_group_id($id_grupo);

            $data = array('groups' => $groups, 'services_autor' => $services_a,
            				'tittle' => $this->tittle_options, 'groups' =>  $goups_options,
            				'services' => $services, 'admin' => $is_admin, 'venues' => $this->venue_options, 'sizes' => $this->size_options);

	    if(($id_grupo==6||$id_grupo==7||$id_grupo==8||$id_grupo==9||$id_grupo==10) && strlen($access_code)>0 && strtoupper(md5($access_code))!=$code) {
               echo "<script>alert('Incorrect Access Code!');window.history.back();</script>";
               return false;
            }            
            
            if ($this->form_validation->run() == FALSE )
            {
            		if($this->ion_auth->is_admin())
                    	$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => true));
            		else
            			$this->load->view('header');
                    $this->load->view('principal', $data);
                    $this->load->view('footer');
            }
            else
            {
                $length = 10;
                $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
            
                    $tittle = $this->input->post("tittle");
                    $name = $this->input->post("name");
                    $gender = $this->input->post("gender");
                    $city = $this->input->post("city");
                    $country = $this->input->post("country");
                    $email = $this->input->post("email");
                    $registre_porfile = $this->input->post("registre_porfile");
                    $afiliation_name = $this->input->post("afiliation_name");
                    $afiliation_address = $this->input->post("afiliation_address");
                    $paper_id1 = $this->input->post("paper_id1");
                    $paper_id2 = $this->input->post("paper_id2");
                    $paper_title1 = $this->input->post("paper_title1");
                    $paper_title2 = $this->input->post("paper_title2");
                    $accept = $this->input->post("accept", 0);
                    $control_num = $this->input->post("control_num");
                    $reg_venue = $this->input->post("reg_venue");
                    $shirt_size = $this->input->post("shirt_size");
                    
                    $additional_data = array(
                                            'name' => $name,
                                            'city' => $city,
                                            'country' => $country,
                                            'afiliation_name' => $afiliation_name,
                                            'afiliation_adress' => $afiliation_address,
                                            'tittle' => $tittle,
                                            'gender' => $gender,
                                            'gaffete' => 0,
                                            'paper_id1' => $paper_id1,
                                            'paper_id2' => $paper_id2,
                                            'title1' => $paper_title1,
                                            'title2' => $paper_title2,
                                            'accept' => $accept,
                                            'control_num' => $control_num,
                                            'reg_venue' => $reg_venue,
                                            'shirt_size' => $shirt_size,
                                            //'access_code' => $access_code,
                                            );
                                                            
                    $user_id = $this->ion_auth->register($email, $password, $email, $additional_data, array($registre_porfile));
                    $user = $this->ion_auth->user($user_id)->row();
                    if (!$is_admin)
                    	$this->ion_auth->login($email, $password, true);
                    $order_id = $this->order_model->create_order($user_id);
                    //var_dump($user);   
                    //Si es autor
                    
                    if($registre_porfile == "2"){
                            $normal_paper = $this->input->post("cb1", 0);
                            $extra_paper = $this->input->post("cb2", 0);
                            $extra_page = $this->input->post("cb3", 0);
                            $conference_dinner = $this->input->post("cb4", 0);
                            $social_program = $this->input->post("cb5", 0);
                            $additional_documentation = $this->input->post("cb6", 0);
                            
                            if($normal_paper){
                                    $this->Service_model->add_user_service($normal_paper, 1, $order_id  );
                            }
                            
                            if($extra_paper){
                                    $this->Service_model->add_user_service($extra_paper, 1, $order_id  );
                            }
                            
                            if($extra_page){
                                    $extra_page_num = $this->input->post("3", 0);
                                    $this->Service_model->add_user_service($extra_page, $extra_page_num, $order_id  );
                            }
                            
                            if($conference_dinner){
                                    $this->Service_model->add_user_service($conference_dinner, 1, $order_id  );
                            }
                            
                            if($social_program){
                                    $this->Service_model->add_user_service($social_program, 1, $order_id  );
                            }
                            
                            if($additional_documentation){
                                    $additional_documentation_num = $this->input->post("6", 0);
                                    //echo $additional_documentation_num;
                                    $this->Service_model->add_user_service($additional_documentation, $additional_documentation_num, $order_id  );
                            }
                            
                    // si es publico en general
                    }else if($registre_porfile == "3"){
                            $conference_dinner = $this->input->post("cb4", 0);
                            $social_program = $this->input->post("cb5", 0);
                            $additional_documentation = $this->input->post("cb6", 0);
                            
                            //Agregamos por defaul el pago de publico general
                            $this->Service_model->add_user_service("7", 1, $order_id  );
                            
                            if($conference_dinner){
                                    $this->Service_model->add_user_service($conference_dinner, 1, $order_id  );
                            }
                            
                            if($social_program){
                                    $this->Service_model->add_user_service( $social_program, 1, $order_id  );
                            }
                            
                            if($additional_documentation){
                                    $additional_documentation_num = $this->input->post("6", 0);
                                    $this->Service_model->add_user_service($additional_documentation, $additional_documentation_num, $order_id  );
                            }
                            
                    //si es estudiante
                    }else if($registre_porfile == "4"){
                            $conference_dinner = $this->input->post("cb4", 0);
                            $social_program = $this->input->post("cb5", 0);
                            $additional_documentation = $this->input->post("cb6", 0);
                            
                            //Agregamos por defaul el pago de publico general
                            $this->Service_model->add_user_service( "8", 1, $order_id  );
                            
                            if($conference_dinner){
                                    $this->Service_model->add_user_service($conference_dinner, 1, $order_id  );
                            }
                            
                            if($social_program){
                                    $this->Service_model->add_user_service( $social_program, 1, $order_id  );
                            }
                            
                            if($additional_documentation){
                                    $additional_documentation_num = $this->input->post("6", 0);
                                    $this->Service_model->add_user_service($additional_documentation, $additional_documentation_num, $order_id  );
                            }
                    
                    //si es compañia
                    }else if($registre_porfile == "5"){
                            $social_program = $this->input->post("cb5", 0);
                            $additional_documentation = $this->input->post("cb6", 0);
                            $not_sponsors = $this->input->post("cb9", 0);
                            
                            if($social_program){
                                    $this->Service_model->add_user_service($social_program, 1, $order_id  );
                            }
                            
                            if($not_sponsors){
                                    $this->Service_model->add_user_service($not_sponsors, 1, $order_id  );
                            }
                            
                            if($additional_documentation){
                                    $additional_documentation_num = $this->input->post("6", 0);
                                    $this->Service_model->add_user_service($additional_documentation, $additional_documentation_num, $order_id  );
                            }
                            
                    }else if($registre_porfile == "11"){
                            $conference_dinner = $this->input->post("cb4", 0);
                            $social_program = $this->input->post("cb5", 0);
                            $additional_documentation = $this->input->post("cb6", 0);
                            
                            //Agregamos por defaul el pago de poster
                            $this->Service_model->add_user_service( "10", 1, $order_id  );
                            
                            if($conference_dinner){
                                    $this->Service_model->add_user_service($conference_dinner, 1, $order_id  );
                            }
                            
                            if($social_program){
                                    $this->Service_model->add_user_service( $social_program, 1, $order_id  );
                            }
                            
                            if($additional_documentation){
                                    $additional_documentation_num = $this->input->post("6", 0);
                                    $this->Service_model->add_user_service($additional_documentation, $additional_documentation_num, $order_id  );
                            }
                    
                    }
                    
                    //enviamos email
                    
                    $order_list = $this->order_model->get_costs($order_id);
                    
                    $total = 0;
                    $totalEuro = 0;
                    foreach($order_list as $o){
                        $total += $o->total;
                        $totalEuro += $o->euro;
                    }
                    
                    $this->load->library('email');
                    
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'conferencecimps@gmail.com',
                        'smtp_pass' => 'conferencecimps2013cimat',
                        'mailtype'  => 'html', 
                        'charset'   => 'iso-8859-1'
                    );
                    
					/*$config['mailtype'] = 'html';
					$config['smtp_port'] = '26';
					$this->email->initialize($config);
					$this->email->from('cimps@cimat.mx', 'CIMPS');
					$this->email->to($user->email);
					
					$this->email->subject('Register CIMPS 2017');
                    $message = $this->load->view('email', array("autor"=>$user, 'password'=>$password, 'total' => $total, 'total_euros' => $totalEuro, 'orden' => $order_list, 'group' => $this->ion_auth->get_users_groups()->row()->name), true);
                    $this->email->message($message);
                    $this->email->send();
                    //echo $this->email->print_debugger();*/
					
					$message = $this->load->view('email', array("autor"=>$user, 'password'=>$password, 'total' => $total, 'total_euros' => $totalEuro, 'orden' => $order_list, 'group' => $this->ion_auth->get_users_groups($user->id)->row()->name), true);
                    $this->load->library('PostageApp');

					$this->postageapp->from('conferencecimps@cimat.mx');
                                        //$this->postageapp->headers(
                                        //  array('MIME-Version: 1.0\r\n'
                                        //));
					$this->postageapp->to($user->email);
					$this->postageapp->subject('Register CIMPS 2017');
					//$this->postageapp->message($message);
                                        $this->postageapp->message(
                                            array('text/html' => $message
                                        ));
					
					$this->postageapp->send();
					
                    $data['user'] = $user;
                    $data['succesfull'] = true;
                    $data['user_group'] = $registre_porfile;
                    $data['costs'] = $order_list;
            		$order = $this->order_model->get_order($data['user']->id);
           			$data['discounts'] = $this->order_model->get_discounts($order->id);
                    $data['crud_user_id'] = $user->id;
                    if ($is_admin)
                    	$data['url_crud_id'] = "/".$user->id;
                    else
                    	$data['url_crud_id'] = "";
                    
                    if ($this->ion_auth->is_admin())
                    	$this->load->view('header' , array('user' => $this->ion_auth->user()->row(), 'admin' => true));
                    else
                    	$this->load->view('header' , array('user' => $user));
                    $this->load->view('modificar', $data);
                    $this->load->view('footer');
                }
        }
        
        function information($user_id=""){
            $this->load->library('form_validation');
            $this->load->library('session');
            $this->load->helper(array('form', 'url'));
            $this->load->library('ion_auth');
            $this->load->model('Service_model');
            $this->load->model('order_model');
        
            $admin = false;
            if (!$this->ion_auth->logged_in())
            {
                redirect('auth');
            }
            
            if ($user_id != ""  &&  $this->ion_auth->is_admin())
            {
            	$admin = $this->ion_auth->user()->row();
            	$data['admin'] = true;
            }
            else
            	$data['admin'] = false;
            
            $groups = $this->ion_auth->groups()->result();
                
            $goups_options = array();
            foreach ($groups as $group){
                    if($group->id != "1"){
                        $goups_options[$group->id] = $group->name;
                    }
            }
            
            if ($data['admin'])
            {
            	$data['user'] = $this->ion_auth->user($user_id)->row();
            	$data['crud_user_id'] = $user_id;
                $data['url_crud_id'] = "/".$user_id;
            }
            else
            {
            	$data['user'] = $this->ion_auth->user()->row();
            	$data['url_crud_id'] = "";
            }
            $order = $this->order_model->get_order($data['user']->id);
            $data['succesfull'] = false;
            $data['correctly'] = $this->session->flashdata('correctly');
            $data['tittle'] = $this->tittle_options;
            $data['user_group'] = $this->ion_auth->get_users_groups($data['user']->id)->row()->id;
            $data['groups'] = $goups_options;
	    $data['accepted'] = false;
            
            if($order){    
                $data['costs'] = $this->order_model->get_costs($order->id);
                $data['discounts'] = $this->order_model->get_discounts($order->id);
		$data['accepted'] = $this->order_model->paid($data['user']->id);
            }
            $data['message'] = $this->session->flashdata('message');
            
            if ($this->ion_auth->is_admin())
           	$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => true));
            else
            	$this->load->view('header', array('user' => $data['user'], 'accepted' => $data['accepted'], 'sizes' => $this->size_options));
            $this->load->view('modificar', $data);
            $this->load->view('footer');
        }
        
        public function update($user_id=""){
            $this->load->library('form_validation');
            $this->load->helper(array('form', 'url'));
            $this->load->library('ion_auth');
            $this->load->model('Service_model');
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
            }
            else
            	$data['admin'] = false;
            
            
            $this->form_validation->set_rules('tittle', 'Tittle', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check_user['.$user_id.']');
            
            //$this->ion_auth->update($user->id, $data);
            $groups = $this->ion_auth->groups()->result();
                
            $goups_options = array();
            foreach ($groups as $group){
                    if($group->id != "1"){
                        $goups_options[$group->id] = $group->name;
                    }
            }
            
            if ($data['admin'])
            {
            	$user = $this->ion_auth->user($user_id)->row();
            	$data['crud_user_id'] = $user_id;
            }
            else
            	$user = $this->ion_auth->user()->row();
            
            $data['user'] = $user;
            $order = $this->order_model->get_order($data['user']->id);
            $data['succesfull'] = false;
            $data['tittle'] = $this->tittle_options;
            $data['user_group'] = $this->ion_auth->get_users_groups($data['user']->id)->row()->id;
            $data['groups'] = $goups_options;
            $data['costs'] = $this->order_model->get_costs($order->id);
            
            if ($this->form_validation->run() == FALSE )
            {
				if ($this->ion_auth->is_admin())
					$this->load->view('header', array('user' => $this->ion_auth->user->row(), 'admin' => true));
	           	else
	            	$this->load->view('header', array('user' => $user));
                $this->load->view('modificar', $data);
                $this->load->view('footer');
            }else{
                $tittle = $this->input->post("tittle");
                $name = $this->input->post("name");
                $gender = $this->input->post("gender");
                $city = $this->input->post("city");
                $country = $this->input->post("country");
                $email = $this->input->post("email");
                $registre_porfile = $this->input->post("registre_porfile");
                $afiliation_name = $this->input->post("afiliation_name");
                $afiliation_address = $this->input->post("afiliation_address");
                
                $user_data = array(
                    'tittle'  => $tittle,
                    'name'    => $name,
                    'gender'  => $gender,
                    'city'    => $city,
                    'country' => $country,
                    'email'   => $email,
                    'afiliation_name' => $afiliation_name,
                    'afiliation_address' => $afiliation_address,
                );
                $this->ion_auth->update($user->id, $user_data);
                $this->session->set_flashdata('message', "User Saved");
                if ($data['admin'])
                	redirect("user/information/".$user_id, 'refresh');
                else
                	redirect("user/information", 'refresh');
            }
        }
        
        public function email_check($email){
        
            if ($this->ion_auth->username_check($this->input->post("email")))
            {
                $this->form_validation->set_message('email_check', 'The email <b>'.$email.'</b> is already register. <a href="'.site_url("auth/forgot_password").'">Forgot your password?</a>');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }


        public function control_num_check($control_num){
        
            if ($this->ion_auth->control_num_check($this->input->post("control_num")))
            {
                $this->form_validation->set_message('control_num_check', 'The Control Number <b>'.$control_num.'</b> is already register.');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        
        
        public function email_check_user($email, $user_id=""){
            $this->load->library('ion_auth');
            if ($user_id != "")
            	$user = $this->ion_auth->user($user_id)->row();
            else
            	$user = $this->ion_auth->user()->row();
            if($user->email == $email){
                return true;
            }
            
            if ($this->ion_auth->username_check($this->input->post("email")))
            {
                $this->form_validation->set_message('email_check_user', 'The email <b>'.$email.'</b> is already register.');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
		
		public function recovery(){
		
			$this->load->library('form_validation');
            $this->load->library('session');
            $this->load->helper(array('form', 'url'));
            $this->load->library('ion_auth');
            $this->load->model('info_model');
		
			
			if($_POST){
			
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('afiliation_name', 'Afiliation Name(University/Company)', 'required');
				$this->form_validation->set_rules('group', 'Group', 'required');
				$this->form_validation->set_rules('total', 'Total', 'required');
				
				if ($this->form_validation->run() == FALSE ){
					$this->load->view('header');
					$this->load->view('recuperar');
					$this->load->view('footer');
				
				}else{
					
					$name = $this->input->post("name");
					$email = $this->input->post("email");
					$afiliation_name = $this->input->post("afiliation_name");
					$group = $this->input->post("group");
					$total = $this->input->post("total");
				
					$this->info_model->add_recovery($name, $email, $afiliation_name, $group, $total);
					
					$this->load->view('header');
					$this->load->view('recuperar', array("ok" => "ok", "email" => $email));
					$this->load->view('footer');
					
				}
			}else{
				
				$groups = $this->ion_auth->groups()->result();
            
				$goups_options = array();
				foreach ($groups as $group){
						if($group->id != "1"){
							$goups_options[$group->id] = $group->name;
						}
				}
				
				$this->load->view('header');
				$this->load->view('recuperar', array('groups' => $goups_options));
				$this->load->view('footer');
				
			}
            
		}
		
		public function send_mail(){
			$this->load->library('ion_auth');
			$this->load->library('email');
			$this->load->model('order_model');
			$this->load->helper('url');
			if (!$this->ion_auth->logged_in())
            {
                redirect('auth');
            }
			
			$user = $this->ion_auth->user()->row();
            $order = $this->order_model->get_order($user->id);
			
			$order_list = $this->order_model->get_costs($order->id);
			$total = 0;
			$totalEuro = 0;
			foreach($order_list as $o){
				$total += $o->total;
				$totalEuro += $o->euro;
			}
			
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'conferencecimps@gmail.com',
                'smtp_pass' => 'conferencecimps2013cimat',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
            
            
			/*$config['mailtype'] = 'html';
			$config['smtp_port'] = '26';
			$this->email->initialize($config);
			$this->email->from('cimps@cimat.mx', 'CIMPS');
			$this->email->to($user->email);
			
			$this->email->subject('Registro CIMPS');
			$message = $this->load->view('email', array("autor"=>$user, 'password'=>'********', 'total' => $total, 'total_euros' => $totalEuro, 'orden' => $order_list, 'group' => $this->ion_auth->get_users_groups()->row()->name), true);
			$this->email->message($message);
			$this->email->send();*/
			
			$message = $this->load->view('email', array("autor"=>$user, 'password'=>'********', 'total' => $total, 'total_euros' => $totalEuro, 'orden' => $order_list, 'group' => $this->ion_auth->get_users_groups()->row()->name), true);
			$this->load->library('PostageApp');

			$this->postageapp->from('conferencecimps@gmail.com');
			$this->postageapp->to($user->email);
			$this->postageapp->subject('Registro CIMPS 2016');
			/* $this->postageapp->message($message); */
                        $this->postageapp->message(
                           array(
                              'text/html'   => $message
                           )
                        );
			
			$this->postageapp->send();
			
			$this->session->set_flashdata('message', "Email send succesfull.");
			redirect("user/information", 'refresh');
			
		}
        
        function mandar(){
            
                    $message = "prueba1";
                    $this->load->library('PostageApp');

                    $this->postageapp->from('conferencecimps@gmail.com');
                    $this->postageapp->to("edgarfur@gmail.com");
                    $this->postageapp->subject('Prueba 123');
                    $this->postageapp->message($message);
        
                   $this->postageapp->send();

        }
		
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
