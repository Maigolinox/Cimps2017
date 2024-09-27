<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	
		$this->load->helper('url');
		$this->load->model('order_model');
		$this->load->library('grocery_CRUD');
        $this->load->library('ion_auth');
	}
	
	public function _crud_add()
	{
		redirect("user/register/admin", 'refresh');
	}
	
	
	public function _crud_export()
	{
		$this->load->model('info_model');
		$data = $this->info_model->get_export_data();
		$columnas = $data->list_fields();
		
		
		$string_to_export = "";
		foreach($columnas as $column){
			$string_to_export .= $column."\t";
		}
		$string_to_export .= "\n";

		foreach($data->result_array() as $row){
			foreach($columnas as $column){
				$campo = $row[$column];
				if ($campo == null  ||  $campo == "")
					$campo = "- - -";
				else if ($column == 'image')
					$campo = base_url()."assets/payments/".$campo;
				
				$string_to_export .= $campo."\t"; 
			}
			$string_to_export .= "\n";
		}
		
		// Convert to UTF-16LE and Prepend BOM
		//$string_to_export = "\xFF\xFE".mb_convert_encoding($string_to_export, 'UTF-16LE', 'UTF-8');
		$string_to_export = "\xFF\xFE".iconv('UTF-8', 'UTF-16LE', $string_to_export);
		
		$filename = "export-".date("Y-m-d_H:i:s").".xls";
		
		header('Content-type: application/vnd.ms-excel;charset=UTF-16LE');
		header('Content-Disposition: attachment; filename='.$filename);
		header("Cache-Control: no-cache");
          	
		echo $string_to_export;
		die();
	}
	
	public function index($accion=""){
		if (!$this->ion_auth->logged_in()  ||  !$this->ion_auth->is_admin())
			redirect('auth');
		
		if ($accion == "add")
			return $this->_crud_add();
		
		else if ($accion == "export")
			return $this->_crud_export();
		
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();
		
			$crud->set_theme('flexigrid');
			$crud->set_table('users');
			$crud->set_subject('Usuario');
			
			$crud->unset_read();
			$crud->unset_edit();
			$crud->add_action("Ver detalles",
								base_url("assets/grocery_crud/themes/flexigrid/css/images/edit.png"),
								"user/information",
								"");
			
			$crud->columns('id', 'tittle', 'name', 'country', 'email', 'afiliation_name', 'gaffete', 'total_pesos', 'total_euros', 'discount', 'discount_euros',
							'total_discount', 'total_discount_euros',
							'grupo', 'comp_pago', 'pagado', 'pago_cash','send_email', 'registro_taller');
			
			$crud->set_relation_n_n("grupo", "users_groups", "groups", "user_id", "group_id", "name");
			
			$crud->display_as('tittle','Title')
				->display_as('grupo', 'Group')
				->display_as('paper_id1', 'Paper 1 ID')
				->display_as('title1', 'Paper 1 Title')
				->display_as('paper_id2', 'Paper 2 ID')
				->display_as('title2', 'Paper 2 Title');
			
			$crud->field_type('gaffete', 'true_false');
			$crud->field_type('pagado', 'true_false');
			
			$crud->callback_column('gaffete', array($this, '_callback_dar_gaffete'));
			$crud->callback_column('total_pesos', array($this, '_callback_total_pesos'));
			$crud->callback_column('total_euros', array($this, '_callback_total_euros'));
			$crud->callback_column('discount', array($this, '_callback_descuento_pesos'));
			$crud->callback_column('discount_euros', array($this, '_callback_descuento_euros'));
			$crud->callback_column('total_discount', array($this, '_callback_total_descuento_pesos'));
			$crud->callback_column('total_discount_euros', array($this, '_callback_total_descuento_euros'));
			$crud->callback_column('comp_pago', array($this, '_callback_link_pago'));
			$crud->callback_column('pagado', array($this, '_callback_aceptar_pago'));
			$crud->callback_column('pago_cash', array($this, '_callback_pago_cash'));
			$crud->callback_column('send_email', array($this, '_send_email'));
			$crud->callback_column('registro_taller', array($this, '_registro_taller'));
			$output = $crud->render();
				
			$this->load->view('header_admin', array('user' => $this->ion_auth->user()->row(), 'admin' => true));
			$this->load->view('admin', $output);
			$this->load->view('footer_admin');
				
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
public function ajax_update_order($user_id, $value)
	{
		/*if (!$this->ion_auth->logged_in()  ||  !$this->ion_auth->is_admin())
			{
		$this->output->set_status_header('403');
		return;
		}*/
	
		$order = $this->order_model->get_order($user_id);
		if ($this->order_model->set_accepted($order->id, $value))
			echo "Success!";
		else
			$this->output->set_status_header('500');
	}
	
	public function ajax_pago_cash($user_id)
	{
		
		$order = $this->order_model->get_order($user_id);
		$this->order_model->update_order('cash', $order->image, $order->bank, 
				$order->reference, date('Y/m/d'), $order->tax_number, $order->id );
				
		echo "Pago cash!";
	}
	
	public function ajax_update_gaffete($user_id, $value)
	{
		$this->ion_auth->update($user_id, array('gaffete' => $value));
		echo "v/";
	}
	
	public function ajax_get_order($user_id)
	{
		$user = $this->ion_auth->user($user_id)->row();
		$order = $this->order_model->get_order($user_id);
		
		$data['user'] = $user;
		$data['order'] = $order;
		$this->load->view('ajax/view_order_data', $data);
	}
	
	public function ajax_update_discount($user_id, $moneda, $valor)
	{
		if ($moneda < 0  ||  $moneda > 1)
		{
			$this->output->set_status_header('500');
			return;
		}
		
		$user = $this->ion_auth->user($user_id)->row();
		$order = $this->order_model->get_order($user_id);
		
		$this->order_model->set_discount($order->id, $moneda, $valor);
		echo "Descuento actualizado!";
	} 
	
	
	public function _callback_total_pesos($value, $row)
	{
		return "<p id='tp_{$row->id}'>"."$".$this->order_model->get_total_costs($row->id)->total_pesos."</p>";
	}
	
	public function _callback_total_euros($value, $row)
	{
		return "<p id='te_{$row->id}'>".$this->order_model->get_total_costs($row->id)->total_euros."€"."</p>";
	}
	
	public function _callback_descuento_pesos($value, $row)
	{
		$valor = "$".$this->order_model->get_order($row->id)->discount;
		$input = "<input type='text' id='discount_pesos_{$row->id}' value='{$valor}' style='width:100%'".
					"onKeyPress='updateTotalDescuento(0, {$row->id});'/>";
	
		return $input;
	}
	public function _callback_descuento_euros($value, $row)
	{
		$valor = $this->order_model->get_order($row->id)->discount_euros."€";
		$input = "<input type='text' id='discount_euros_{$row->id}' value='{$valor}' style='width:100%'".
					"onKeyPress='updateTotalDescuento(1, {$row->id});'/>";
		return  $input;
	}
	
	public function _callback_total_descuento_pesos($value, $row)
	{
		$total = $this->order_model->get_total_costs($row->id)->total_pesos;
		$descuento = $this->order_model->get_order($row->id)->discount;
		$total_descuento = $total-$descuento;
		$p = "<p id='tdp_{$row->id}'>"."$".$total_descuento."</p>";
		
		return $p;
	}
	public function _callback_total_descuento_euros($value, $row)
	{
		$total = $this->order_model->get_total_costs($row->id)->total_euros;
		$descuento = $this->order_model->get_order($row->id)->discount_euros;
		$total_descuento = $total-$descuento;
		$p = "<p id='tde_{$row->id}'>".$total_descuento."€"."</p>";
		
		return $p;
	}
	
	public function _callback_link_pago($value, $row)
	{
		$order = $this->order_model->get_order($row->id);
	
		if (($order->type_payment != "cash")  &&  ($order->reference == null  ||  $order->reference == "")   &&   ($order->image == null  ||  $order->image == ""))
			return "<p id='link_pago_{$row->id}'> - - - </p>";
		//$link = base_url()."assets/payments/".$imagen;
		return "<a href='javascript:void(0);' onClick='verPago({$row->id})'>Ver</a>";
	}
	
	public function _send_email($value, $row)
	{
		$html = "<div style=\"{$style}\"> <button type='button' onClick='sendEmailById(".$row->id.")'>Send email</button></div>";
		return $html;
	}


		public function _registro_taller($value, $row)
	{
		$redirect = "http://srcimps.cimat.mx:8080/cimatcimps/web/index.php?correo=".$row->email."&key=".md5("GiUt@*q564h85m&".$row->email); 
		//$html = "<a href='http://srcimps.cimat.mx:8080/cimatcimps/web/index.php?correo=".$row->email."&key=".md5("GiUt@*q564h85m&".$row->email)."'''/>Inscribir a taller</a>";
		$html = "<a href=\"{$redirect}\">Inscribir a taller</a>";
		return $html;
	}

	function mandarEmail()
	{
        	$this->load->library('ion_auth');
   		$this->load->library('email');
        	$user = $this->ion_auth->user($_POST['id_user'])->row();
        	$this->load->library('PostageApp');
    	 	$config = Array(
            		'protocol' => 'smtp',
            		'smtp_host' => 'smtp.gmail.com',
            		'smtp_port' => 25,//465,
            		'smtp_user' => 'conferencecimps@cimat.mx',
            		'smtp_pass' => 'cimps2016@cimat',
            		'mailtype'  => 'html', 
            		'charset'   => 'iso-8859-1'
        	);
			
			if($this->ion_auth->get_users_groups($user->id)->row()->id != 13) {
				$message = '<html><header></header><body>
				<br/><br/>
				Hola '.set_value('name', $user->name).'.
				<br/><br/>
				Gracias por realizar tu pago para asistir al <a href="http://cimps.cimat.mx">Congreso Internacional en Mejora de Procesos de Software</a>, 
				ahora puedes continuar con la inscripción a los distintos talleres y ponencias disponibles en nuestro programa, 
				recuerda que el cupo es limitado y que puedes inscribirte a los talleres y ponencias que sean de tu interés y que se ajusten a la disponibilidad de tu horario. 
				Puedes hacerlo a través del siguiente enlace:
				<br/><br/>
				Accede a tu registro con tu usuario y contraseña:
				http://cimps.cimat.mx/registro/
				<br/><br/>
				•	Busca la opcion en el menu: INSCRIPCIÓN a CONFERENCIAS; SESIONES Y TALLERES. <br/><br/>
				•	En la nueva ventana selecciona en el menu superior: programa general. <br/><br/>
				•	Recuerda que hay sesiones paralelas y podras acceder a un solo bloque de horario. <br/><br/>
				•	Favor de confirmar asistencia.<br/><br/>
				•	En caso de seleccionar un taller, favor de revisar los requisitos para participar.<br/><br/>
				•	Ahí debes confirmar asistencia o cancelar selección para volver a elegir un horario. <br/><br/>
				•	Una vez confirmada la asistencia ya no podrá ser modificada. <br/><br/>
				Si tienes dudas consulta los pasos en: <br/><br/>
				http://cimps.cimat.mx/registration-steps/  <br/><br/> 

				Nota: Favor de llevar su código QR impreso y su comprobante de pago el día del evento.
				
				<br/><br/><strong>¡*IMPORTANTE!<strong/> Debido a cambios en la logística, ahora puedes inscribirte a más de dos talleres, revisa la disponibilidad de horario y el cupo límite. <br/><br/>
					<strong>¡**IMPORTANTE!<strong/> Recuerda verificar el horario de tus talleres constantemente ya que se pueden presentar cambios de último momento. Se te informa que para cualquier taller es necesario que lleves contigo tu ordenador portátil. Así mismo, es necesario que previamente a tu inscripción en cualquier taller, revises los requisitos específicos que cada uno de los talleres solicita.
					<br/><br/>
					<a href="http://www.facebook.com/CIMPS" target="_blank"><img alt="Siguenos en Facebook" src="https://lh6.googleusercontent.com/-CYt37hfDnQ8/T3nNydojf_I/AAAAAAAAAr0/P5OtlZxV4rk/s32/facebook32.png" width=32 height=32/>Siguenos en Facebook</a>
				</body></html>';	

			} else {
				$message = '<html><header></header><body>
				<br/><br/>
				Hola '.set_value('name', $user->name).'.
				<br/><br/>
				Gracias por realizar tu pago para asistir al <a href="http://cimps.cimat.mx">Congreso Internacional en Mejora de Procesos de Software</a>, 
				ahora puedes continuar con la inscripción a los distintos talleres y ponencias disponibles en nuestro programa, 
				recuerda que el cupo es limitado y que puedes inscribirte a los talleres y ponencias que sean de tu interés y que se ajusten a la disponibilidad de tu horario. 
				Puedes hacerlo a través del siguiente enlace:
				<br/><br/>
				Accede a tu registro con tu usuario y contraseña:
				http://cimps.cimat.mx/registro/
				<br/><br/>
				•	Busca la opcion en el menu: INSCRIPCIÓN a CONFERENCIAS; SESIONES Y TALLERES. <br/><br/>
				•	En la nueva ventana selecciona en el menu superior: programa general. <br/><br/>
				•	Recuerda que hay sesiones paralelas y podras acceder a un solo bloque de horario. <br/><br/>
				•	Para confirmar asistencia seleccione menú eventos seleccionados aparacera la lista dar clic en ✅ para confirmar asistencia o cancelar. Una vez confirmado no hay cancelaciones. Esta acción también puedes realizarla desde el programa, con los botenes de confirmar ✅ o cancelar ❌.<br/><br/>
				•	Ahí debes confirmar asistencia o cancelar selección para volver a elegir un horario. <br/><br/>
				•	Los eventos seleccionados le habilitarán el link a Meet. <br/><br/>
				Si tienes dudas consulta los pasos en: <br/><br/>
				http://cimps.cimat.mx/registration-steps/  <br/><br/> 

				Nota: Se habiltiará el acceso a todo aquel que suba su comprobante de pago. Favor de registrar su nombre formal ya que se elaborarà su consntacia digital.<br/><br/>
				
				<br/><br/>
					<strong>¡**IMPORTANTE!<strong/> Recuerda verificar el horario de tu taller constantemente así como sus requisitos, ya que se pueden presentar cambios de último momento. Se te informa que en algunos talleres es necesario que lleves contigo tu ordenador portátil y el software necesario preinstalado. Asímismo, es necesario que previamente a tu inscripción en cualquier taller, revises los requisitos específicos que cada uno de los talleres solicita.
					<br/><br/>
					<a href="http://www.facebook.com/CIMPS" target="_blank"><img alt="Siguenos en Facebook" src="https://lh6.googleusercontent.com/-CYt37hfDnQ8/T3nNydojf_I/AAAAAAAAAr0/P5OtlZxV4rk/s32/facebook32.png" width=32 height=32/>Siguenos en Facebook</a>
				</body></html>';	

		}


        
        	$this->load->library('PostageApp');
		$this->postageapp->subject('CIMPS: Registro Disponible Para Conferencias Sesiones Y Talleres');
		$this->postageapp->from('conferencecimps@cimat.mx');
		
		$this->postageapp->to(set_value('email', $user->email));
		//$this->postageapp->bcc('isaac.rodriguez@cimat.mx');		
		//$this->postageapp->subject('CIMPS: Registro Disponible Talleres');
        	$this->postageapp->message(
            		array('text/html' => $message
        	));
		return json_encode(array('success'=>$this->postageapp->send()));
    	}

	public function _callback_pago_cash($value, $row)
	{
		//$link = base_url()."assets/payments/".$imagen;
		return "<button type='button' onClick='pagoCash({$row->id})'>Cash Payment</button>";
	}
	
	public function _callback_aceptar_pago($value, $row)
	{
		$aceptado = $this->order_model->get_order($row->id)->accepted;
		if ($aceptado)
		{
			$checked = "checked";
			$color = "rgba(0, 255, 0, 0.33)";
		}
		else
		{
			$checked = "";
			$color = "rgba(255, 0, 0, 0.33)";
		}
		$style = "background-color: {$color};";
	
		$html = "<div style=\"{$style}\"> <input type='checkbox' value='{$row->id}' id='check_{$row->id}' {$checked} onClick='updateOrderPayment(this)'/> </div>";
	
		return $html;
	}
	
	public function _callback_dar_gaffete($value, $row)
	{
		$user_id = $row->id;
		$gaffete = $this->ion_auth->user($row->id)->row()->gaffete;
		if ($gaffete)
		{
			$checked = "checked";
			$color = "rgba(0, 255, 0, 0.33)";
		}
		else
		{
			$checked = "";
			$color = "rgba(255, 0, 0, 0.33)";
		}
		$style = "background-color: {$color};";     
		
		$html = "<div style=\"{$style}\"> <input type='checkbox' value='{$row->id}' id='gafette_{$row->id}' {$checked} onClick='updateGaffete(this)'/> </div>";
		
		return $html;
	}
	
	public function recovery(){
	
		/*if (!$this->ion_auth->logged_in()  ||  !$this->ion_auth->is_admin())
			redirect('auth'); */
	
		$crud = new grocery_CRUD();
		
		$crud->set_theme('flexigrid');
		$crud->set_table('recovery');
		$crud->set_subject('Recovery');
		
		$output = $crud->render();
				
		$this->load->view('header_admin', array('user' => $this->ion_auth->user()->row(), 'admin' => true));
		$this->load->view('admin', $output);
		$this->load->view('footer_admin');
		
	}
	
	
}

?>
