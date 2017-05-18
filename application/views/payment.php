<ul class="nav nav-justified">
          <li><a href="http://cimps.cimat.mx/registration_system/index.php/user/"><?php echo lang("cimps_MenuHome"); ?></a></li>
		  <li><a href="<?php echo site_url('user/information'.$url_crud_id) ?>"><?php echo lang("cimps_MenuUpdate"); ?></a></li>
          <li class="active"><a href="<?php if (isset($admin) && $admin)
          						echo site_url('payment/index'.$url_crud_id);
          					 else 
          						echo site_url('payment'); ?>"><?php echo lang("cimps_MenuAdd"); ?></a></li>
          <li><a href="<?php echo site_url('auth/change_password') ?>"><?php echo lang("cimps_MenuChange"); ?></a></li>
          <li><a href="http://cimps.ingsoft.info/contact-information" target="_blank"><?php echo lang("cimps_MenuContact"); ?></a></li>
		  <li><a href="<?php echo site_url('auth/logout') ?>"><?php echo lang("cimps_MenuLogout"); ?></a></li>
        </ul>
<br/><div style="margin:20px;"></div>
		<div class="row">
		  <div class="col-md-8">
			<h2 style="text-align: center"><?php echo lang("cimps_PagPayment"); ?></h2>


			<!-- Informacion de pago -->
			<?php echo (!empty($suc)) ? '<div class="alert alert-success">'.$suc.'</div>' : ''?>
			<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF;">
				<div style="margin-left: -15px; margin-top: -15px;">
					<!--logo-->
					<img style=" width:8%; height: 8%": src="<?php echo base_url() ?>assets/img/logo_paym_state.png" />
					<div style="margin-left: 50px; margin-right: 15px;">
						

						<table class="table table-condensed">
							<tr>
								<td style="padding-right:3em"><b><?php echo lang("cimps_PagRegistro"); ?></b></td>
								<td style="padding-right:3em"><b><?php echo lang("cimps_PagAmountPesos"); ?></b></td>
								<td><b><?php echo lang("cimps_PagAmountEuros"); ?></b></td>
								<tr>
									<?php $total = 0; $totalEuro = 0; ?>
									<?php foreach($costs as $cost): ?>
										<?php $total += $cost->total; $totalEuro += $cost->euro;?>
										<tr>
											<td><?php echo $cost->name ?></td>
											<td>$<span class="cost"><?php echo $cost->total ?></span></td>
											<td><span class="cost"><?php echo $cost->euro ?></span>€</td>
										</tr>
									<?php endforeach; ?>
									<tr>
										<td><b>Total</b></td>
										<td><b>$<span class="cost"><?php echo $total ?></span></b></td>
										<td><b><span class="cost"><?php echo $totalEuro  ?></span>€</b></td>
									</tr>
									<?php if ($discounts->discount != 0  ||  $discounts->discount_euros != 0) :?>
										<tr>
											<td><b>Discount</b></td>
											<td><b>$<span class="cost"><?php echo $discounts->discount ?></span></b></td>
											<td><b><span class="cost"><?php echo $discounts->discount_euros ?></span>€</b></td>
										</tr>
										<tr class="success">
											<td><b>Grand Total</b></td>
											<td><b>$<span class="cost"><?php echo $total - $discounts->discount ?></span></b></td>
											<td><b><span class="cost"><?php echo $totalEuro - $discounts->discount_euros ?></span>€</b></td>
										</tr>
									<?php endif ?>
								</table>
							</div>						
						</div> 
					</div>

			<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
			<?php echo (!empty($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : ''?>
			<form role="form" method="post" action="<?php echo site_url('payment/add'.$url_crud_id) ?>" enctype="multipart/form-data">




				<!-- PayPal button to pay in mexican pesos -->  
				<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF; margin-top: 30px;">
					<div style="margin-left: -15px; margin-top: -15px;">
						<!--logo-->
						<img style=" width:8%; height: 8%": src="<?php echo base_url() ?>assets/img/icono_info_user.png" />
					</div>    
					<div style="margin-left: 30px;"> 

						
					</div>
					<div class='row'>
						<div class="col-md-6 pull-right">
							<strong><?php echo lang("cimps_paypal_mexican"); ?></strong>
							<form action='https://www.paypal.com/cgi-bin/webscr' method='post' name='form' style="margin-right: 20px;">
								<input type='hidden' name='business' value='admeventos@cimat.mx'>
								<input type='hidden' name='cmd' value='_xclick'> 
								<input type='hidden' name='item_name' value='Pago para CIMPS 2017'>
								<input type='hidden' name='item_number' value='1'>
								<input type='hidden' name='amount' value='<?php echo $total ?>'>
								<input type='hidden' name='no_shipping' value='1'>
								<input type='hidden' name='currency_code' value='MXN'>
								<input type='hidden' name='cancel_return' value='http://cancel.com'>
								<input type='hidden' name='return' value='http://return.com/'>
								<input type="image"   src="https://paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit">
							</form>
							<!-- PayPal button to pay in euros -->
						</div>
						<div class="col-md-6 pull-left">
							<strong><?php echo lang("cimps_paypal_euros"); ?></strong>
							<form action='https://www.paypal.com/cgi-bin/webscr' method='post' name='form' style="">
								<input type='hidden' name='business' value='admeventos@cimat.mx'>
								<input type='hidden' name='cmd' value='_xclick'> 
								<input type='hidden' name='item_name' value='Pay to CIMPS 2017'>
								<input type='hidden' name='item_number' value='1'>
								<input type='hidden' name='amount' value='<?php echo $totalEuro ?>'>
								<input type='hidden' name='no_shipping' value='1'>
								<input type='hidden' name='currency_code' value='EUR'>
								<input type='hidden' name='cancel_return' value='http://cancel.com'>
								<input type='hidden' name='return' value='http://return.com/'>
								<input type="image"   src="https://paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit">
							</form>
						</div>

					</div>

				</div>

				
				







			  <div class="form-group">
			    <label for="exampleInputEmail1"><?php echo lang("cimps_PagWaysPayment"); ?></label>
			    <?php echo form_dropdown('payment_type', $payment_type, set_value('payment_type', $order->type_payment), 'class="form-control"') ?>
			  </div>
			  <h5><?php echo lang("cimps_PagDigitalize"); ?></h5>
			  <div class="form-group">
			  	<label for="inputName"><?php echo lang("cimps_PagDate"); ?></label>
					<div>
					 	<input id="date" value="<?php echo set_value('date', $order->date) ?>" name="date" type="text" class="form-control" placeholder="Date">
					</div>
			  </div>
			  <div class="form-group">
				<label for="inputName"><?php echo lang("cimps_PagBank"); ?></label>
					<div>
					 	<input name="bank" value="<?php echo set_value('bank', $order->bank) ?>" type="text" class="form-control" placeholder="Bank">
					</div>
				</div>
			<div class="form-group">
				<label for="inputName"><?php echo lang("cimps_PagReference"); ?></label>
				 <div>
					 <input type="text" name="reference" value="<?php echo set_value('reference', $order->reference) ?>" class="form-control" placeholder="Reference">
				 </div>
			  </div>
			  <div class="form-group">
			  	<label for="inputName"><?php echo lang("cimps_PagTax"); ?></label>
					<div>
					 	<input name="tax_number" value="<?php echo set_value('reference', $order->tax_number) ?>" type="text" class="form-control" placeholder="tax">
					</div>
			  </div>
			  <label><?php echo lang("cimps_PagData_Invoice"); ?></label>
			  <div class="form-group">
				<label for="inputName"><?php echo lang("cimps_PagData_advice"); ?></label>
				  	<select name="tax" id="tax" class="form-control">
					  <option value="1"><?php echo lang("cimps_PagResponseY"); ?></option>
					  <option value="0"><?php echo lang("cimps_PagResponseN"); ?></option>
					</select>
			</div>
			<div id="extra" <?php echo (empty($order->organization))? 'style="display:none;"' : 'style=""' ?>>
				<h6><?php echo lang("cimps_PagIfResponseN"); ?></h6>
				<div class="form-group">
					<label for="organization"><?php echo lang("cimps_PagOrganization"); ?></label>
					 <div>
						 <input name="organization" type="text" value="<?php echo set_value('organization', $order->organization) ?>" class="form-control" placeholder="organization">
					 </div>
				</div>
				<div class="form-group">
					<label for="address"><?php echo lang("cimps_PagAddres"); ?></label>
					 <div>
						 <input name="adress" type="text" value="<?php echo set_value('adress', $order->adress) ?>" class="form-control" placeholder="address">
					 </div>
				</div>
				<div class="form-group">
					<label for="locality"><?php echo lang("cimps_PagLocality"); ?></label>
					 <div>
						 <input name="locality" type="text" value="<?php echo set_value('locality', $order->locality) ?>" class="form-control" placeholder="locality">
					 </div>
				</div>
				<div class="form-group">
					<label for="postal_code"><?php echo lang("cimps_PagPostalCode"); ?></label>
					 <div>
						 <input name="postal_code" type="text" value="<?php echo set_value('postal_code', $order->postal_code) ?>" class="form-control" placeholder="postal_code">
					 </div>
				</div>
				<div class="form-group">
					<label for="country"><?php echo lang("cimps_PagCountry"); ?></label>
					 <div>
						 <input name="country" type="text" value="<?php echo set_value('country', $order->country) ?>" class="form-control" placeholder="country">
					 </div>
				</div>
				<div class="form-group">
					<label for="phone_number"><?php echo lang("cimps_PagPhoneNumber"); ?></label>
					 <div>
						 <input name="phone_number" type="text" value="<?php echo set_value('phone_number', $order->phone_number) ?>" class="form-control" placeholder="phone_number">
					 </div>
				</div>
			</div>
			  <div class="form-group">
			    <div><?php if(!empty($order->image)){ ?>
				<a href="<?php echo base_url()."assets/payments/".$order->image ?>"><?php echo base_url()."assets/payments/".$order->image ?></a>
			    <?php } ?></div>
			    <label for="exampleInputFile"><?php echo lang("cimps_PagProofofPayment"); ?></label>
			    <input name="proof_payment" type="file" id="exampleInputFile">
			  </div>
			  <div class="col-md-4">
			  <button class="btn btn-primary btn-md btn-block" type="submit" style="margin-left:-15px;"><?php echo (empty($order->payment_type)) ? lang("cimps_PagSubmit") : 'Update Payment'; ?></button>
			  </div>
			</form>
		</div>



	     <div class="col-md-4">
<h3><?php echo lang("cimps_Payment_Method"); ?></h3>
<pre><?php echo lang("cimps_Barralateralpago"); ?></pre>
		 </div>
	</div>
	<script>
	  $(function() {
		$( "#date" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  yearRange: "2016:2016"
		});
		
		$('#tax').on('change', function() {
		  /*if( this.value =="1" ){
			extra
		  }*/
		  $("#extra").toggle();
		});
		
	  });
	</script>

