<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class P extends CI_Controller {

	public function index($user_id=""){
		$this->load->helper(array('form', 'url'));
        $this->load->model('order_model');
        $this->load->model('Service_model');
        $this->load->library('ion_auth');

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
			$user = $this->ion_auth->user($user_id)->row();
			$data['crud_user_id'] = $user_id;
			$data['url_crud_id'] = "/".$user_id;
		}
		else
		{
			$user = $this->ion_auth->user()->row();
			$data['url_crud_id'] = "";
		}
		
		$user_group =  $this->ion_auth->get_users_groups($user->id)->row()->id;

		$data['user_group'] = $user_group;
		$data['user'] = $user;
		$order = $this->order_model->get_order($data['user']->id);
		$data['order'] = $order;
		$data['groups'] = $goups_options;
		$data['costs'] = $this->order_model->get_costs($order->id);
        $data['discounts'] = $this->order_model->get_discounts($order->id);
		$data['services'] = $services = $this->Service_model->get_services();
		$data['services_autor'] = $this->Service_model->get_services_by_group_id($user_group);
		//$data['user_group'] = $this->ion_auth->get_users_groups()->row()->id;

		$total = 0;
		$totalEuro = 0;
		foreach($data['costs'] as $o){
			$total += $o->total;
			$totalEuro += $o->euro;
		}

		$data['total'] = $total;
		$data['totalEuro'] = $totalEuro;
		$data['total_final'] = $total - $data['discounts']->discount;
		$data['total_final_euro'] = $totalEuro - $data['discounts']->discount_euros;
		
		if ($this->ion_auth->is_admin())
			$this->load->view('header', array('user' => $this->ion_auth->user()->row(), 'admin' => true));
		else
			$this->load->view('header', array('user' => $data['user']));
        $this->load->view('p', $data);
        $this->load->view('footer');
	}

	public function update($user_id=""){
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->library('ion_auth');
		$this->load->model('Service_model');
		$this->load->model('order_model');

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
		}
		else
		{
			$data['admin'] = false;
			$user = $this->ion_auth->user()->row();
		}
		
		$user_group =  $this->ion_auth->get_users_groups($user->id)->row()->id;
		$this->ion_auth->remove_from_group(array($user_group), $user->id);

		$registre_porfile = $this->input->post("registre_porfile");
		$this->order_model->add_to_group($registre_porfile, $user->id);

		$order = $this->order_model->get_order($user->id);
		$this->order_model->delete_services($order->id);
		$order_id = $order->id;
		$paper_id1 = $this->input->post("paper_id1");
		$paper_id2 = $this->input->post("paper_id2");

		if($registre_porfile == 2){// si es autor
			$paper_title1 = $this->input->post("paper_title1");
			$paper_title2 = $this->input->post("paper_title2");

			 $user_data = array(
				'paper_id1' => $paper_id1,
				'paper_id2' => $paper_id2,
				'title1' => $paper_title1,
				'title2' => $paper_title2,
			 );

			 $this->ion_auth->update($user->id, $user_data);
		}

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
						$this->Service_model->add_user_service($additional_documentation, $additional_documentation_num, $order_id );
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

		}

		$this->session->set_flashdata('message', "User information Saved");
		
		if ($data['admin'])
			redirect("user/information/".$user_id, 'refresh');
		else
			redirect("user/information", 'refresh');
	}
}