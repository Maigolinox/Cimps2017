<tr>
						<td style="padding-right:3em"><b>Registration </b></td>
						<td style="padding-right:3em"><b>Amount(Mexican Pesos $) </b></td>
						<td><b>Amount(Euros ) </b></td>
				   <tr>
<?php foreach ($services as $service):?>
				   <tr>
						<td style="padding-right:3em">
							<div class="checkbox" style="margin-top:0px; margin-bottom:0px">
								<label>
									<?php if(!$service->marked){ ?>
									<input name="cb<?php echo $service->id ?>" class="service" type="checkbox" value="<?php echo $service->id ?>" >
									<?php echo $service->name ?>
									<?php }else{ ?>
									    <input class="service" type="checkbox" value="<?php echo $service->id ?>" checked disabled>
										<?php echo '<input type="hidden" name="cb'.$service->id.'" value="'.$service->id.'" />' ?>
										<b> <?php echo $service->name?> </b>
									<?php } ?>
								</label>
								<?php if(!$service->onlyone) echo '<input style="width:30px;" id="s_'.$service->id.'" name="'.$service->id.'" class="spinner" type="text" value="1">'  ?>
							</div>
						</td>
						<td style="padding-right:3em">$<span class="cost"><?php echo $service->cost ?></span></td>
						<td><span class="cost"><?php echo $service->euro ?></span>€</td>
				   <tr>
<?php endforeach;?>
<tr>
						<td style="padding-right:3em"><b>Total</b></td>
						<td style="padding-right:3em">$<b id="total">0</b></td>
						<td><b id="total_euros">0</b>€</td>
				   <tr>
				   
<?php if($group == 2){ ?>

<?php } ?>