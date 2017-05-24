<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.9";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

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
			<input name="identity" type="text" class="form-control" placeholder="<?php echo lang('cimps_user');?>" autofocus>
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
			

				<button class="btn btn-lg btn-primary btn-block" type="submit">FACEBOOK</button>
				<button class="btn btn-lg btn-primary btn-block" type="submit">GOOGLE</button>

			<div class="pull-right">
				<a href="http://127.0.0.1:4001/wordpress/registration_system/index.php/user/register"><?php echo lang('cimps_Sign_up');?></a></p>
			</div>

					
			
			
		</form>
		
	</div>
</div>
