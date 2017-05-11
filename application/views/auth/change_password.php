<ul class="nav nav-justified">
        <li><a href="http://cimps.cimat.mx/registration_system/index.php/user/"><?php echo lang("cimps_MenuHome"); ?></a></li>
    <li><a href="<?php echo site_url('user/information') ?>"><?php echo lang("cimps_MenuUpdate"); ?></a></li>
        <li><a href="<?php if (isset($admin) && $admin)
                      echo site_url('payment/index'.$url_crud_id);
                     else 
                      echo site_url('payment'); ?>"><?php echo lang("cimps_MenuAdd"); ?></a></li>
        <li class="active"><a href="<?php echo site_url('auth/change_password') ?>"><?php echo lang("cimps_MenuChange"); ?></a></li>
        <li><a href="http://cimps.ingsoft.info/contact-information" target="_blank"><?php echo lang("cimps_MenuContact"); ?></a></li>
    <li><a href="<?php echo site_url('auth/logout') ?>"><?php echo lang("cimps_MenuLogout"); ?></a></li>
        </ul>
<h3><strong><?php echo lang('change_password_heading');?></strong></h3>

<div id="infoMessage"><?php echo $message;?></div>

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

      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>

<?php echo form_close();?>
