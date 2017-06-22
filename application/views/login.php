<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="fb-root"></div>


<div class="row">
	<div class="col-md-6">
		<a href="http://cimps.cimat.mx/#"><img src="<?php echo base_url() ?>assets/img/logo2017.png"/></a>
		<br><br>	
	</div>
	<div class="col-md-6">
		<?php if(!empty($message)){ ?>
		<div class="alert alert-danger"><?php echo $message;?></div>
		<?php } ?>
		<?php if(!empty($correctly)){ ?>
		<div class="alert alert-succes"><?php echo $correctly;?></div>
		<?php } ?>

		<form class="form-signin" action="<?php echo base_url() ?>" method="post" style="font-family:Tahoma,Arial;">
			<h3 class="form-signin-heading"><strong><?php echo lang('cimps_login');?></strong></h3>
			<div id="FaceEmail">
			<input id="EmailCorreo" name="identity" type="text" class="form-control" placeholder="<?php echo lang('cimps_user');?>" autofocus>
			</div>
			<input name="password" type="password" class="form-control" placeholder="<?php echo lang('cimps_password');?>">
			<label class="checkbox">
				<input  name="remember" type="checkbox" value="remember-me"> <?php echo lang('cimps_rememberme');?>
			</label>
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo lang('cimps_Signin');?></button>

			<div>
				<div class="pull-right">
					<a href="<?php echo site_url("user/recovery") ?>"><?php echo lang('cimps_login_problem');?></a></p>
				</div>
				<div class="pull-left">
					<a href="<?php echo site_url("auth/forgot_password") ?>"><?php echo lang('cimps_ForgotPass');?></a></p>
				</div>										
			</div>

			<br>				
			
			
		</form>

		<div style="text-align:center;">

			<div style="margin-bottom: 5px;">
				<form action="http://localhost:4001/wordpress/registration_system/index.php/user/register" method="get">
					<input type="hidden" name="LoginFacebook" value="true" />			
					<button style="background-color: #4267b2;  font: 145% sans-serif;" class="btn" type="submit"><i style="color: white;" class="fa fa-facebook-official fa-lg" aria-hidden="true">&nbsp;<?php echo lang('cimps_Sign_FB');?></i></button>
				</form>
			</div>

			<form action="http://localhost:4001/wordpress/registration_system/index.php/user/register" method="get">
				<input type="hidden" name="LoginGoogle" value="true" />			
				<button style="background-color: #D34836;  font: 160% sans-serif;" class="btn" type="submit"><i style="color: white;" class="fa fa-google fa-lg" aria-hidden="true">&nbsp;<?php echo lang('cimps_Sign_G');?></i></button>
			</form>
			
			<form class="form-signin">
				<div style="text-align:right;">
					<a href="http://localhost:4001/wordpress/registration_system/index.php/user/register"><?php echo lang('cimps_Sign_up');?></a></p>
				</div>
			</form>
		</div>
		
	</div>
</div>
