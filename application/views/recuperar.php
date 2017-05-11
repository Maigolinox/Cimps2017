<div style="margin:20px;"></div>
	  <div class="row">
	   <div class="col-md-8">
	  
	  <h3><strong><?php echo lang("cimps_recover_account"); ?></strong></h3>
	  <? if(isset($ok)){ ?>
			<div class="alert alert-success">Tu información fue agregada correctamente, después de que confirmemos tu información tus datos de acceso serán enviados a tu dirección de correo electrónico(<?php echo $email ?>).</div>
	  <? }else{ ?>
	    <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
		<?php echo (!empty($message)) ? '<div class="alert alert-success">'.$message.'</div>' : ""; ?>
        <form method="post" action="" role="form">
									
			<div class="form-group">
				<label for="inputName"><?php echo lang("cimps_recover_name");?></label>
				<div>
			 		<input value="<?php echo set_value('name') ?>" name="name" type="text" class="form-control" placeholder="<?php echo lang("cimps_recover_name_placeholder");?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail"><?php echo lang("cimps_recover_email");?></label>
			    <div>
			      <input value="<?php echo set_value('email') ?>" type="email" name="email" class="form-control" id="inputEmail1" placeholder="<?php echo lang("cimps_recover_email_placeholder");?>">
			    </div>
		    </div>
		  <div class="form-group">
		    <label for="inputAfilation1"><?php echo lang("cimps_recover_afiliation");?></label>
		    <div>
		      <input value="<?php echo set_value('afiliation_name') ?>" type="text" name="afiliation_name" class="form-control" id="inputAfiliation" placeholder="<?php echo lang("cimps_recover_afiliation_placeholder");?>">
		    </div>
		  </div>
		  <div class="form-group">
		  	<label for="title"><?php echo lang("cimps_recover_profile");?></label>
			<div>
				<select class="form-control" id="group" name="group">
					<?php foreach($groups as $group): ?>
						<option value="<?php echo $group ?>"><?php echo $group ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		   </div>
		   <div class="form-group">
		    <label for="inputAfilation1"><?php echo lang("cimps_recover_total");?></label>
		    <div>
		      <input value="<?php echo set_value('total') ?>" type="text" name="total" class="form-control" id="inputAfiliation" placeholder="<?php echo lang("cimps_recover_total_placeholder");?>">
		    </div>
		  </div>
		   <div class="col-md-4">
		      <button class="btn btn-primary btn-md btn-block" type="submit" style="margin-left:-15px;"><?php echo lang("cimps_recover_send");?></button>
		   </div>
		</form>
    <? } ?>
	</div>
		<div class="col-md-4"></div>
	</div>