	  <ul class="nav nav-justified">
          <li><a href="http://cimps.cimat.mx/registration_system/index.php/user/"><?php echo lang("cimps_MenuHome"); ?></a></li>
		  <li class="active" ><a href="<?php echo site_url('user/information'.$url_crud_id) ?>"><?php echo lang("cimps_MenuUpdate"); ?></a></li>
          <li><a href="<?php if (isset($admin) && $admin)
          						echo site_url('payment/index'.$url_crud_id);
          					 else 
          						echo site_url('payment'); ?>"><?php echo lang("cimps_MenuAdd"); ?></a></li>
          <li><a href="<?php echo site_url('auth/change_password') ?>"><?php echo lang("cimps_MenuChange"); ?></a></li>
          <li><a href="http://cimps.ingsoft.info/contact-information" target="_blank"><?php echo lang("cimps_MenuContact"); ?></a></li>
		  <li><a href="<?php echo site_url('auth/logout') ?>"><?php echo lang("cimps_MenuLogout"); ?></a></li>
        </ul>
	  <div style="margin:20px;"></div>
	  <div class="row">
	   <div class="col-md-8">
	  <?php if($succesfull){ ?>
	  <div class="alert alert-success">
	   <?php echo lang("cimps_Message"); ?>
	 </div>
	  <?php } ?>
	 <!-- <a class="btn btn-primary" href="<?php // echo site_url('descargas/constanciaPDF'); ?>">Descargar constancia de asistencia en PDF</a> -->
	  <h2><?php echo lang("cimps_user_information"); ?></h2>
	    <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
		<?php echo (!empty($message)) ? '<div class="alert alert-success">'.$message.'</div>' : ""; ?>
        <form method="post" action="<?php
        								if (isset($admin) && $admin)
        									echo site_url('user/update/'.$crud_user_id);
        								else 
        									echo site_url('user/update');
        							?>" role="form">
		  <div class="form-group">
		  	<label for="title"><?php echo lang("cimps_Tittletag"); ?></label>
			<div>
			  	<?php echo form_dropdown('tittle', $tittle, set_value('tittle', $user->tittle), 'class="form-control"'); ?>
			</div>
		   </div>
			<div class="form-group">
				<label for="inputName"><?php echo lang("cimps_Nametag"); ?></label>
				<div>
			 		<input value="<?php echo set_value('name', $user->name) ?>" name="name" type="text" class="form-control" placeholder="Name">
				</div>
			</div>
			<div class="form-group">
				<label for="inputName"><?php echo lang("cimps_Gender"); ?></label>
				<div>
				<div class="radio">
				  <label>
				    <input type="radio" name="gender" id="optionsRadios1" value="female" <?php if(set_value('gender', $user->gender) == "female") echo "checked" ?>>
				    <?php echo lang("cimps_Female"); ?>
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="gender" id="optionsRadios2" value="male" <?php if(set_value('gender', $user->gender) == "male") echo "checked" ?>>
				    <?php echo lang("cimps_Male"); ?>
				  </label>
				</div>
				
				</div>
			</div>
			<div class="form-group">
				<label for="inputCity"><?php echo lang("cimps_Citytag"); ?></label>
				<div>
			 		<input value="<?php echo set_value('city', $user->city) ?>" name="city" type="text" class="form-control" placeholder="City">
				</div>
			</div>
			<div class="form-group">
				<label for="inputCountry"><?php echo lang("cimps_Countrytag"); ?></label>
				<div>
			 		<input value="<?php echo set_value('country', $user->country) ?>" type="text" name="country" class="form-control" placeholder="Country">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail"><?php echo lang("cimps_Email_add"); ?></label>
			    <div>
			      <input value="<?php echo set_value('email', $user->email) ?>" type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email">
			    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputAfilation1"><?php echo lang("cimps_Afiliationtag"); ?></label>
		    <div>
                       <input value="<?php echo set_value('reg_venue', $user->reg_venue) ?>" type="hidden" name="reg_venue" id="regVenue">
                       <input value="<?php echo set_value('afiliation_name', $user->afiliation_name) ?>" type="text" name="afiliation_name" class="form-control" id="inputAfiliation" placeholder="Afiliation Name" <?php if(intval($user->reg_venue)!=2) echo "readonly" ?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputAfilation2"><?php echo lang("cimps_AfiliationAddresstag"); ?></label>
		    <div>
		      <input value="<?php echo set_value('afiliation_address', $user->afiliation_adress) ?>" type="text" name="afiliation_address" class="form-control" id="inputAfiliation2" placeholder="Afiliation Address">
		    </div>
		  </div>
                  <div class="form-group" id="contenedor_matricula">
                     <label for="inputControlNum"><?php echo lang("cimps_Control_Numtag"); ?></label>
                     <div><input value="<?php echo set_value('control_num', $user->control_num) ?>" name="control_num" type="text" maxlength="12" name="control_num" class="form-control" placeholder="ControlNum"></div>
                  </div>
                  <div class="form-group" id="contenedor_tallas">
                     <label for="inputShirtSize"><?php echo lang("cimps_Shirt_Size"); ?></label>
	             <div>
			<?php echo form_dropdown('shirt_size', $sizes, set_value('shirt_size', $user->shirt_size), 'class="form-control" id="size"'); ?>
		     </div>
                  </div>
                  <div>
		      <?php //"<button type="submit" class="btn btn-default"><?php echo lang("cimps_update_information"); </button>" ?>
		    </div><br>
		  <div class="form-group">
		  	<label for="title"><?php echo set_value('cimps_Register_Profile') ?></label>
			<div>
				<?php echo form_dropdown('registre_porfile', $groups, set_value('registre_porfile', $user_group), 'class="form-control" id="group"  disabled'); ?>
			</div>
		   </div>
		</form>
	<table class="table table-condensed">
			<tr>
						<td style="padding-right:3em"><b><?php echo lang("cimps_Registration"); ?></b></td>
						<td style="padding-right:3em"><b>Amount(Mexican Pesos $)</b></td>
						<td><b>Amount(Euros )</b></td>
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
			<div class="col-md-4"><a href="<?php
        						if (isset($admin) && $admin)
        							echo site_url('p/index/'.$crud_user_id);
        						else 
        							echo site_url('p');
        					?>" class="btn btn-primary btn-md btn-block" style="margin-left:-15px;"><?php echo lang("cimps_change"); ?></a></div>
<div class="col-md-4"><a href="<?php echo site_url('qrcode/index/'.$user->id); ?>" class="btn btn-primary btn-md btn-block"><?php echo lang("cimps_qr_code"); ?></a></div>
	</div> 
		<div class="col-md-4">
					<h3><?php echo lang("cimps_Payment_Method"); ?></h3>
<pre><?php echo lang("cimps_Barralateralpago"); ?></pre>
          		</div>
	</div>

        <script>
	   $(document).ready(function() {
            
               idGroup = $("#group").val();
               regVenue = $("#regVenue").val();
            
               if(idGroup != 4){
                  $("#contenedor_matricula").hide();
                  $("#contenedor_tallas").hide();
               } else if(regVenue !=1) {
                  $("#contenedor_matricula").hide();
               }
            
	   });
	</script>
