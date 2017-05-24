<!--RECUPERAR / ACTIVAR CUENTA-->
<div style="margin:20px;"></div>

<div class="row">
	<div class="col-md-6">
		
	<a href="http://cimps.cimat.mx/#"><img src="<?php echo base_url() ?>assets/img/logo2017.png"/></a>
	</div>

<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF;" class="col-md-6">

	<div style="margin-left: -40px; margin-top: -25px;">
		<!--logo-->
		<img style=" width:50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_info_per.png" />
	</div>
	<div style="margin: -35px 20px 0px 50px;">
		<label >
		<h3><?php echo lang("cimps_recover_account"); ?></h3>
		</label>
	</div> 


	<div style="margin-left: 35px; margin-right: 15px;">



		<h3><strong></strong></h3>
		<? if(isset($ok)){ ?>
		<div class="alert alert-success">Tu información fue agregada correctamente, después de que confirmemos tu información tus datos de acceso serán enviados a tu dirección de correo electrónico(<?php echo $email ?>).</div>
		<? }else{ ?>
		<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
		<?php echo (!empty($message)) ? '<div class="alert alert-success">'.$message.'</div>' : ""; ?>
		<form method="post" action="" role="form">

			<div class="form-group">
				<label for="inputName"><?php echo lang("cimps_recover_name");?></label>
				<div>
					<input style="width: 400px" value="<?php echo set_value('name') ?>" name="name" type="text" class="round" placeholder="<?php echo lang("cimps_recover_name_placeholder");?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail"><?php echo lang("cimps_recover_email");?></label>
				<div>
					<input  style="width: 400px" value="<?php echo set_value('email') ?>" type="email" name="email" class="round" id="inputEmail1" placeholder="<?php echo lang("cimps_recover_email_placeholder");?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputAfilation1"><?php echo lang("cimps_recover_afiliation");?></label>
				<div>
					<input style="width: 400px" value="<?php echo set_value('afiliation_name') ?>" type="text" name="afiliation_name" class="round" id="inputAfiliation" placeholder="<?php echo lang("cimps_recover_afiliation_placeholder");?>">
				</div>
			</div>
			<div class="form-group">
				<label for="title"><?php echo lang("cimps_recover_profile");?></label>
				<div>
					<select style="width: 400px" class="round" id="group" name="group">
						<?php foreach($groups as $group): ?>
							<option value="<?php echo $group ?>"><?php echo $group ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputAfilation1"><?php echo lang("cimps_recover_total");?></label>
				<div>
					<input style="width:400px" value="<?php echo set_value('total') ?>" type="text" name="total" class="round" id="inputAfiliation" placeholder="<?php echo lang("cimps_recover_total_placeholder");?>">
				</div>
			</div>
			
		</form>
		<? } ?>
	</div>

</div>
</div>
<br>
<div class="col-md-6"></div>
<div class="col-md-4">
	<button class="btn btn-primary btn-md btn-block" type="submit" style="margin-left:-15px"><?php echo lang("cimps_recover_send");?></button>
</div>
<br>