<!--Modificar el perfil de registro-->
<!--Menu-->
<ul class="nav nav-justified">


	<li>
		<a  href="http://cimps.cimat.mx/registro/index.php/user/" >
			<img  src="<?php echo base_url() ?>assets/img/logo_home.png" style="width:30px;height:30px; margin: -30px -30px -30px -30px;">
		</a>
	</li>
	<li class="active" ><a href="<?php echo site_url('user/information'.$url_crud_id) ?>">Update Information</a></li>

	<li><a href="<?php if (isset($admin) && $admin)
		echo site_url('payment/index'.$url_crud_id);
		else 
			echo site_url('payment');  ?>">Add Payment</a></li>

		<li><a href="http://cimps.cimat.mx/contact-information/" target="_blank">Contact</a></li>

	</ul>

        <!--/Menu-->
	  <div style="margin:50px;"></div>
	  <div class="row">
	   <div class="col-md-10">
	   <form method="post" action="<?php echo site_url('p/update'.$url_crud_id); ?>" role="form">


	   	<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF;">
	   	<div style="margin-left: -25px; margin-top: -25px;">
     		<!--logo-->
    		 <img style=" width:50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_info_per.png" />
     		<div style="margin: -35px 20px 0px 50px;">
          	<label >
            	<h3>Register Profile</h3>
	          </label>
    	  </div> 
 		</div>  
 		<div style="margin-left: 35px; margin-right: 15px;">
		<div class="form-group">
		  	<div>
				<?php echo form_dropdown('registre_porfile', $groups, set_value('registre_porfile', $user_group), 'class="round" id="group"');?>
			</div>
		</div>
		<div>
			  		<div class="form-group" id="contenedor_matricula" <?php if($user_group != 4) echo 'style="display:none"' ?>>
						<label for="inputControlNum">ControlNum</label>
						<div>
							<input value="<?php echo set_value('control_num', $user->control_num) ?>" name="control_num" id="control_num" type="text" maxlength="12" name="control_num" class="round" placeholder="ControlNum">						
						</div>
					</div>
					<div class="form-group" id="contenedor_codigo" style="display:none;">
						<label for="inputAccessCode">AccessCode</label>
						<div>
							<input value="<?php echo set_value('access_code', $user->access_code) ?>" name="access_code" id="access_code" type="password" maxlength="25" name="access_code" class="round" placeholder="AccessCode">
						</div>
					</div>
					<div>

			   <table id="services" class="table table-condensed">
				   <tr>
						<td style="padding-right:3em"><b>Registration</b></td>
						<td style="padding-right:3em"><b>Amount(Mexican Pesos $)</b></td>
						<td><b>Amount(Euros )</b></td>
				   <tr>
				   <?php foreach ($services_autor as $service):?>
				        <?php $service->quantity = 1; ?>
						<?php foreach ($costs as $c):
							if($c->id == $service->id){
								if($service->marked){
									$service->disable = 1;
								}else{
									$service->marked = 1;
								}
								
								$service->quantity = $c->quantity;
							}
						 endforeach;?>
					    <tr>
							<td style="padding-right:3em">
								<div class="checkbox" style="margin-top:0px; margin-bottom:0px">
									<label>
										<?php if(!$service->marked){ ?>
										<input name="cb<?php echo $service->id ?>" class="service" type="checkbox" value="<?php echo $service->id ?>" >
										<?php }else{ ?>
											<input <?php if(!isset($service->disable)) echo 'name="cb'.$service->id.'"' ?> class="service" type="checkbox" value="<?php echo $service->id ?>" checked <?php if(isset($service->disable)) echo "disabled" ?>>
											<?php if(isset($service->disable)) echo '<input type="hidden" name="cb'.$service->id.'" value="'.$service->id.'" />' ?>
										<?php } ?>
										<?php echo $service->name ?>
									</label>
									<?php if(!$service->onlyone) echo '<input style="width:30px;" id="s_'.$service->id.'" name="'.$service->id.'" class="spinner" type="text" value="'.$service->quantity.'">'  ?>
								</div>
							</td>
							<?php if($service->id == "11"){ ?>
								<td style="padding-right:3em"><span class="cost"><?php echo $service->cost ?></span>%</td>
							<?php }else{ ?>
								<td style="padding-right:3em">$<span class="cost"><?php echo $service->cost ?></span></td>
							<?php } ?>
							<?php if($service->id == "11"){ ?>
								<td><span class="cost"><?php echo $service->euro ?></span>%</td>
							<?php }else{ ?>
								<td><span class="cost"><?php echo $service->euro ?></span>€</td>
							<?php } ?>
					    <tr>
				   <?php endforeach;?>
				   <tr <?php if ($discounts->discount == 0  &&  $discounts->discount_euros == 0) echo 'class="success"' ?>>
						<td style="padding-right:3em"><b>Total</b></td>
						
						<td style="padding-right:3em">$<b id="total"><?php echo intval($total) ?></b></td>
						<td><b id="total_euros"><?php echo intval($totalEuro) ?></b>€</td>
				   </tr>
				   <tr id='row_discount' <?php if ($discounts->discount == 0  &&  $discounts->discount_euros == 0) echo "style='display:none'"?>>
				   		<td style="padding-right:3em"><b>Discount</b></td>
						<td style="padding-right:3em">$<b><?php echo $discounts->discount ?></b></td>
						<td><b><?php echo $discounts->discount_euros ?></b>€</td>
				   </tr>
				   <tr id='row_grand_totals' class="success" <?php if ($discounts->discount == 0  &&  $discounts->discount_euros == 0) echo "style='display:none'"?>>
				   		<td style="padding-right:3em"><b>Grand Total</b></td>
						<td style="padding-right:3em">$<b id="grand_total"><?php echo $total - $discounts->discount ?></b></td>
						<td><b id="grand_total_euros"><?php echo $totalEuro - $discounts->discount_euros ?></b>€</td>
				   </tr>
			   </table>
			   <table id="paper" class="table" width="100%" <?php if($user_group != 2) echo 'style="display:none"' ?>>
				  <tr>
					<td width="20%"><b>Paper ID</b></td>
					<td width="80%"><b>Title</b></td>
				  </tr>
				  <tr >
					<td ><input value="<?php echo set_value('paper_id1', $user->paper_id1) ?>" type="text" name="paper_id1" class="form-control" id="paper_id1" ></td>
					<td><input value="<?php echo set_value('paper_title1', $user->title1) ?>" type="text" name="paper_title1" class="form-control" id="paper_title1"></td>
				  </tr>
				  <tr>
					<td><input value="<?php echo set_value('paper_id2', $user->paper_id2) ?>" type="text" name="paper_id2" class="form-control" id="paper_id2" ></td>
					<td><input value="<?php echo set_value('paper_title2', $user->title2) ?>" type="text" name="paper_title2" class="form-control" id="paper_title2"></td>
				  </tr>
			  </table>
		   </div>
		   </div>
		   </div>

	    <div class="col-md-4">
	    		<br>
		  <button class="btn btn-primary btn-md btn-block" type="submit" style="margin-left:-15px;">Update</button>
		</div>
		

	   </form>
	 

	   	<div class="col-md-2"></div></div>




	   <script>
		$(document).ready(function() {
			
			var total = <?php echo $total ?>;
			var iva = false;
			var totalEuros = <?php echo $totalEuro ?>;
			var descuento = <?php echo $discounts->discount ?>;
			var descuentoEuros = <?php echo $discounts->discount_euros ?>;

			var rowDiscount = $("#row_discount").clone();
			var rowGrandTotals = $("#row_grand_totals").clone();
			
			var s = new Array();
			<?php foreach ($costs as $c): ?>
			s[<?php echo $c->id ?>] = <?php echo $c->quantity ?>;
			<?php endforeach;?>
			
			
			$.fn.digits = function(){ 
				return this.each(function(){ 
					$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
				})
			}
			
			$(".cost").digits();
						
			var services = new Array();
			<?php foreach ($services as $service):?>
			  services[<?php echo $service->id ?>] = {cost:<?php echo $service->cost ?>,euro:<?php echo $service->euro ?>,onlyone:<?php echo $service->onlyone ?>};
			<?php endforeach;?>
			
			idGroup = $("#group").val();
			
			var spinner = $( ".spinner" ).spinner({
				change: function( event, ui ) {
					id = $(this).attr("name");
					act = $(this).val();
					c = s[id];
					servicio = services[id];
					if(c > 0){
							cs = act - c;
							total -= servicio.cost * c
							totalEuros -= servicio.euro * c;
							
							total += servicio.cost * act
							totalEuros += servicio.euro * act;
							
							s[id] = act;
						
					}
					$("#total").text(numeral(total).format('0,0'));
           			$("#total_euros").text(numeral(totalEuros).format('0,0'))
				},  min: 1
				
				
			});
			
			$(".spinner").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });

		
			$("#group").change(function() {
			   $.get('<?php echo site_url("user/services_ajax"); ?>' + "/" + $(this).val(), function(data) {
				  $('#services').html(data);
				  rowDiscount.appendTo("#services");
				  rowGrandTotals.appendTo("#services");
				  $(".cost").digits();
					total = 0;
					totalEuros = 0;
					idGroup = $("#group").val();
					
					if(idGroup != 2){
						$("#paper").hide();
					}else{
						$("#paper").show();
						$("#contenedor_codigo").hide();
					}
					if(idGroup != 4){
						$("#contenedor_matricula").hide();
					}else{
						$("#contenedor_matricula").show();
						$("#contenedor_codigo").hide();
					}
					
					if(idGroup == "3"){    //General Public
						total += 1100;
						totalEuros += 58;
						setTotals("#total", total, "#total_euros", totalEuros);
						$("#contenedor_codigo").hide();
					}else if(idGroup == "4"){   //Students
						total += 500;
						totalEuros += 27;
						setTotals("#total", total, "#total_euros", totalEuros);
						$("#contenedor_matricula").show();
					}else if(idGroup == "11"){   // Professors
						total += 950;
						totalEuros += 50;
						setTotals("#total", total, "#total_euros", totalEuros);
						$("#contenedor_matricula").show();
					}else if(idGroup == "2"){   //Author
						total += 6900;
						totalEuros += 380;
						setTotals("#total", total, "#total_euros", totalEuros);
					}else if(idGroup == "5"){   //Companies not sponsors
						total += 750;
						totalEuros += 38;
						setTotals("#total", total, "#total_euros", totalEuros);
						$("#contenedor_codigo").hide();
					}
					if(idGroup == 6){
						$("#contenedor_codigo").show();
					}if(idGroup == 7){
						$("#contenedor_codigo").show();
					}if(idGroup == 8){
						$("#contenedor_codigo").show();
					}if(idGroup == 9){
						$("#contenedor_codigo").show();
					}
					if(idGroup == 10){
						$("#contenedor_codigo").hide();
					}
				  $(".spinner").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
				  var spinner = $( ".spinner" ).spinner({
				change: function( event, ui ) {
					id = $(this).attr("name");
					
					act = $(this).val();
					c = s[id];
					servicio = services[id];
					if(c > 0){
							cs = act - c;
							total -= servicio.cost * c
							totalEuros -= servicio.euro * c;
							
							total += servicio.cost * act
							totalEuros += servicio.euro * act;
							
							s[id] = act;
						
					}
					$("#total").text(numeral(total).format('0,0'));
           			$("#total_euros").text(numeral(totalEuros).format('0,0'))
				},  min: 1
				
				
			});
				  changeCheckbox();
				  changeInput();
				});
			});
			
			
			changeCheckbox();
			changeInput();
			
			function changeCheckbox(){
			$('.service').change(function(){
			
				servicio = services[$(this).val()]
			
if(this.checked){
				if (servicio.cost == 16) {
						iva= true;
						total = total * 1.16;
						totalEuros = totalEuros * 1.16;
				}else{
					if(servicio.onlyone){ 
						if (iva){
							total = total / 1.16;
							totalEuros = totalEuros / 1.16;
							total += servicio.cost;
							totalEuros += servicio.euro;
							total = total * 1.16;
							totalEuros = totalEuros * 1.16;
						}else{
							total += servicio.cost;
							totalEuros += servicio.euro;
						}
					}else{
						if (iva){
							total = total / 1.16;
							totalEuros = totalEuros / 1.16;
							num = $("#s_" + $(this).val()).val();
							s[$(this).val()] = num;
							total += servicio.cost * num;
							totalEuros += servicio.euro * num;
							total = total * 1.16;
							totalEuros = totalEuros * 1.16;
						}else{
							num = $("#s_" + $(this).val()).val();
							s[$(this).val()] = num;
							total += servicio.cost * num;
							totalEuros += servicio.euro * num;
						}
					}	
				}  
	  		}else{
				if (servicio.cost == 16) {
						iva = false;
						total = total / 1.16;
						totalEuros = totalEuros / 1.16;
				}else{
					if(servicio.onlyone){
						if (iva){
							total = total / 1.16;
							totalEuros = totalEuros / 1.16;
							total -= servicio.cost;
							totalEuros -= servicio.euro;
							total = total * 1.16;
							totalEuros = totalEuros * 1.16;
						}else{
							total -= servicio.cost;
							totalEuros -= servicio.euro;
						}			
					}else{
						if (iva){
							total = total / 1.16;
							totalEuros = totalEuros / 1.16;
							ns = s[$(this).val()];
							total -= servicio.cost * ns;
							totalEuros -= servicio.euro * ns;
							s[$(this).val()] = -1;
							total = total * 1.16;
							totalEuros = totalEuros * 1.16;
						}else{
							ns = s[$(this).val()];
							total -= servicio.cost * ns;
							totalEuros -= servicio.euro * ns;
							s[$(this).val()] = -1;
						}
					}
				}   
	  			
	  		}

			  	$("#total").text(numeral(total).format('0,0'));
           		$("#total_euros").text(numeral(totalEuros).format('0,0'))
				
			});
			}
			
			
			
			function changeInput(){
			
			$( ".spinner" ).on('input', function() {
				id = $(this).attr("name");
				act = $(this).val();
					c = s[id];
					servicio = services[id];
					if(c > 0){
							cs = act - c;
							total -= servicio.cost * c
							totalEuros -= servicio.euro * c;
							
							total += servicio.cost * act
							totalEuros += servicio.euro * act;
							
							s[id] = act;
						
					}
					setTotals("#total", total, "#total_euros", totalEuros);
				
			});
		    }

		    function setTotals(elemTotal, total, elemTotalEuros, totalEuros)
		    {
				$(elemTotal).text(total);
				$(elemTotalEuros).text(totalEuros);
				$("#grand_total").text(total - descuento);
				$("#grand_total_euros").text(totalEuros - descuentoEuros);
		    }
			
			
			
		});
	</script>
</div>
</div>
