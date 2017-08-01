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
		<div id="Rcp" style="display: none;">
			<h3 class="form-signin-heading"><strong><?php echo lang('cimps_login');?></strong></h3>

			
				<div id="FaceEmail">
					<input id="EmailCorreo" name="identity" type="text" class="form-control" placeholder="<?php echo lang('cimps_user');?>" autofocus>
				</div>
				<input name="password" type="password" class="form-control" placeholder="<?php echo lang('cimps_password');?>">
				<label class="checkbox">
					<input  name="remember" type="checkbox" value="remember-me"> <?php echo lang('cimps_rememberme');?>
				</label>

				
				<div>
					<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo lang('cimps_Signin');?></button>
				</div>
				<div>
					<div class="pull-right">
						<a href="<?php echo site_url("user/recovery") ?>"><?php echo lang('cimps_login_problem');?></a></p>
					</div>
					<div class="pull-left">
						<a href="<?php echo site_url("auth/forgot_password") ?>"><?php echo lang('cimps_ForgotPass');?></a></p>
					</div>										
				</div>

				<br>				
			</div>
			<!--6Lf_5icUAAAAAKJs_6JPoDDVtZRmbzd7dgtv35Sr-->
			<h3 id='lvcaptcha' class="form-signin-heading"><strong><?php echo lang('cimps_captcha');?></strong></h3>
			<div style="margin-bottom: 20px;" id='recaptcha' class="g-recaptcha" data-sitekey="6LeTKisUAAAAAGwn_QA5QV6fo7XFI5Ln9DzIiAkz" data-callback="onSubmit"></div>

		</form>

		<div style="text-align:center;">

			<div style="margin-bottom: 5px;">
				<form action=" <?php echo site_url("user/register") ?>" method="get">
					<input type="hidden" name="LoginFacebook" value="true" />			
					<button style="background-color: #4267b2;  font: 145% sans-serif;" class="btn" type="submit"><i style="color: white;" class="fa fa-facebook-official fa-lg" aria-hidden="true">&nbsp;<?php echo lang('cimps_Sign_FB');?></i></button>
				</form>
			</div>

			<form action="
			<form action="<?php echo site_url("user/register") ?> " method="get">
				<input type="hidden" name="LoginGoogle" value="true" />			
				<button style="background-color: #D34836;  font: 160% sans-serif;" class="btn" type="submit"><i style="color: white;" class="fa fa-google fa-lg" aria-hidden="true">&nbsp;<?php echo lang('cimps_Sign_G');?></i></button>
			</form>
			
			<form class="form-signin">
				<div style="text-align:right;">
					<a href="<?php echo site_url("user/register") ?>"><?php echo lang('cimps_Sign_up');?></a></p>
				</div>
			</form>
		</div>
		
	</div>
</div>

<script>
  function onSubmit(token) {
    div = document.getElementById('Rcp');
    div.style.display = '';
    div = document.getElementById('recaptcha');
    div.style.display = 'none';
    h3 = document.getElementById('lvcaptcha');
   h3.style.display ='none';
  }

  function validate(event) {
    event.preventDefault();
    if (!document.getElementById('field').value) {
      alert("You must add text to the required field");
    } else {
      grecaptcha.execute();
    }
  }

  function onload() {
    var element = document.getElementById('submit');
    element.onclick = validate;
  }
</script>
