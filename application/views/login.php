<div class="container">
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
			<br/><br/>
			<h5><a href="<?php echo site_url("user/recovery") ?>"><?php echo lang('cimps_login_problem');?></a></p></h5>
			<h5><a href="<?php echo site_url("auth/forgot_password") ?>"><?php echo lang('cimps_ForgotPass');?></a></p></h5>
	      </form>

    </div> 

    <!-- This is a sample comment -->

