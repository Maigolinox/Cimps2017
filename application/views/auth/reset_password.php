<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF; margin-right: 300px;">

  <div style="margin-left: -30px; margin-top: -30px;">
    <img style=" width:8%; height: 8%": src="<?php echo base_url() ?>assets/img/logo_ch_psw.png" />   
  </div>
  	<div style="margin: -35px 20px 0px 50px;">
			<label >
				<h3><strong><?php echo lang('reset_password_heading');?></strong></h3>
			</label>
		</div> 
  	<div style="margin: 5px 20px 20px 60px;">


  		<div id="infoMessage"><?php echo $message;?></div>

  		<?php echo form_open('auth/reset_password/' . $code);?>

  		<p>
  			<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
  			<?php echo form_input($new_password);?>
  		</p>

  		<p>
  			<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
  			<?php echo form_input($new_password_confirm);?>
  		</p>

  		<?php echo form_input($user_id);?>
  		<?php echo form_hidden($csrf); ?>

  		<p><?php echo form_submit('submit', lang('reset_password_submit_btn'));?></p>

  		<?php echo form_close();?>
  	</div>
</div>