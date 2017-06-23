<!--OLVIDE MI CONTRACEÑA-->

<div class="row">
	<div class="col-md-6">
		
		<a href="http://cimps.cimat.mx/#"><img src="<?php echo base_url() ?>assets/img/logo2017.png"/></a>
	</div>

	<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF;" class="col-md-6">
		<div style="margin-left: -40px; margin-top: -25px;">
			<!--logo-->
			<img style=" width:50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_ch_psw.png" />
		</div>
		<div style="margin: -35px 20px 0px 50px;">
			<label >
				<h3><?php echo lang('forgot_password_heading');?></h3>
			</label>
		</div> 


		<div style="margin-left: 35px;">
			<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

			<div id="infoMessage"><?php echo $message;?></div>

			<?php echo form_open("auth/forgot_password");?>

			<p>
				<label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
				<?php echo form_input($email);?>
			</p>


		</div>

	</div>
	<div class="row">
	<div class="col-md-6" style="margin-top: 10px; margin-left: -10px;"><br>
			<?php echo form_submit('submit', lang('forgot_password_submit_btn'));?>

			<?php echo form_close();?>
		</div>
	</div>
</div>