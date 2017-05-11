	<ul class="nav nav-justified">
        <li><a href="http://cimps.cimat.mx/registration_system/index.php/user/"><?php echo lang("cimps_MenuHome"); ?></a></li>
		<li><a href="<?php echo site_url('user/information') ?>"><?php echo lang("cimps_MenuUpdate"); ?></a></li>
        <li class="active"><a href="<?php if (isset($admin) && $admin)
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
	</div>
</div>		

