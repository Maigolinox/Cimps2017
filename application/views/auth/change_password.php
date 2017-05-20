<!--Clase para cambiar parwword-->

 <!--Menu-->
 <ul class="nav nav-justified">
    <li>
        <a  href="http://127.0.0.1:4001/wordpress/registration_system/index.php/user/" >
            <img  src="<?php echo base_url() ?>assets/img/logo_home.png" style="width:30px;height:30px; margin: -30px -30px -30px -30px;">
        </a>
    </li>
    <!--<li><a href="http://cimps.cimat.mx/registration_system/index.php/user/"><?php echo lang("cimps_MenuHome"); ?></a></li>-->
    <li><a href="<?php echo site_url('user/information'.$url_crud_id) ?>"><?php echo lang("cimps_MenuUpdate"); ?></a></li>
    <li><a href="<?php if (isset($admin) && $admin)
        echo site_url('payment/index'.$url_crud_id);
        else 
            echo site_url('payment'); ?>"><?php echo lang("cimps_MenuAdd"); ?></a></li>

        <!--REGISTRO DE CURSO-->
            <?php if(isset($user) && !empty($user)){ ?>
                <?php if (isset($admin)){ ?>
                <?php } else { ?> 
                <?php if($accepted) { ?>
                <li>
                <a href="http://sistemas.ita.mx/fieat/registro/?id=<?php echo $user->id ?>&title=<?php echo $user->tittle ?>&name=<?php echo $user->name ?>&university=<?php echo $user->afiliation_name ?>&email=<?php echo $user->email ?>"><?php echo lang("cimps_add_course");?></a>
                 </li>
            <?php } } } ?>
       <!--/REGISTRO DE CURSO-->

      


        <li><a href="http://cimps.ingsoft.info/contact-information" target="_blank"><?php echo lang("cimps_MenuContact"); ?>
            
        </a></li>
        <!--<li><a href="<?php echo site_url('auth/logout') ?>"><?php echo lang("cimps_MenuLogout"); ?></a></li>-->
    </ul>
    <!--Menu-->
<h2  style="text-align: center;"><strong><?php echo lang('change_password_heading');?></strong></h2>

<div id="infoMessage"><?php echo $message;?></div>




 
<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF; margin-right: 300px;">

  <div style="margin-left: -30px; margin-top: -30px;">
    <img style=" width:8%; height: 8%": src="<?php echo base_url() ?>assets/img/logo_ch_psw.png" />   
  </div>

  <div style="margin: 5px 20px 20px 70px;">
    <?php echo form_open("auth/change_password");?>
    <p>
      <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
      <?php echo form_input($old_password);?> 
    </p>

    <p>
      <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
      <?php echo form_input($new_password);?>
    </p>

    <p>
      <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
      <?php echo form_input($new_password_confirm);?>
    </p>   
  </div>
</div>
<div>
  <?php echo form_input($user_id);?>
  <p style="margin-top: 20px;"><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>

  <?php echo form_close();?>
</div>