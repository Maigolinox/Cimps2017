	  <div style="margin:20px;"></div>
	  <div class="row">
	  <div class="col-md-8">
	  <h1><?php echo lang("cimps_Register"); ?></h1>
	  <h6><?php echo lang("cimps_Required"); ?></h6>
	  <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <form method="post" action="<?php if (isset($admin) &&  $admin)
        										echo site_url('user/register/admin');
        									else
        										echo site_url('user/register'); ?>" role="form">
		  <div class="form-group">
		  	<label for="title"><?php echo lang("cimps_Tittletag"); ?></label>
			<div>
			  	<?php echo form_dropdown('tittle', $tittle, set_value('tittle'), 'class="form-control"'); ?>
			</div>
		   </div>
			<div class="form-group">
				<label for="inputName"><?php echo lang("cimps_Nametag"); ?></label>
				<div>
			 		<input value="<?php echo set_value('name') ?>" name="name" type="text" class="form-control" placeholder="Name">
				</div>
			</div>
			<div class="form-group">
				<label for="inputName"><?php echo lang("cimps_Gender"); ?></label>
				<div>
				<div class="radio">
				  <label>
				    <input type="radio" name="gender" id="optionsRadios1" value="female" <?php if(set_value('gender') == "female") echo "checked" ?>>
				    <?php echo lang("cimps_Female"); ?>
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="gender" id="optionsRadios2" value="male" <?php if(set_value('gender') == "male") echo "checked" ?>>
				    <?php echo lang("cimps_Male"); ?>
				  </label>
				</div>
				
				</div>
			</div>
			<div class="form-group">
				<label for="inputCity"><?php echo lang("cimps_Citytag"); ?></label>
				<div>
			 		<input value="<?php echo set_value('city') ?>" name="city" type="text" class="form-control" placeholder="City">
				</div>
			</div>
			<div class="form-group">
				<label for="inputCountry"><?php echo lang("cimps_Countrytag"); ?></label>
				<div>
			 		<input value="<?php echo set_value('country') ?>" type="text" name="country" class="form-control" placeholder="Country">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail"><?php echo lang("cimps_Email_add"); ?></label>
			    <div>
			      <input value="<?php echo set_value('email') ?>" type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email">
			    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputAfilation1"><?php echo lang("cimps_Afiliationtag"); ?></label>
		    <div>
		      <input value="<?php echo set_value('afiliation_name') ?>" type="text" name="afiliation_name" class="form-control" id="inputAfiliation" placeholder="Afiliation Name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputAfilation2"><?php echo lang("cimps_AfiliationAddresstag"); ?></label>
		    <div>
		      <input value="<?php echo set_value('afiliation_address') ?>" type="text" name="afiliation_address" class="form-control" id="inputAfiliation2" placeholder="Afiliation Address">
		    </div>
		  </div>
		  <div class="form-group">
		  	<label for="title"><?php echo set_value('cimps_Register_Profile') ?></label>
			<div>
				<?php echo form_dropdown('registre_porfile', $groups, set_value('registre_porfile'), 'class="form-control" id="group"'); ?>
			</div>
		   </div>
		       <div>
			   <table id="services" class="table table-condensed">
				   <tr>
						<td style="padding-right:3em"><b><?php echo lang("cimps_Registration"); ?></b></td>
						<td style="padding-right:3em"><b>Amount(Mexican Pesos $)</b></td>
						<td><b>Amount(Euros )</b></td>
				   <tr>
				   <?php foreach ($services_autor as $service):?>
				   <tr>
						<td style="padding-right:3em">
							<div class="checkbox" style="margin-top:0px; margin-bottom:0px">
								<label>
								    <?php if(!$service->marked){ ?>
									<input name="cb<?php echo $service->id ?>" class="service" type="checkbox" value="<?php echo $service->id ?>" >
									<?php }else{ ?>
									    <input class="service" type="checkbox" value="<?php echo $service->id ?>" checked disabled>
										<?php echo '<input type="hidden" name="cb'.$service->id.'" value="'.$service->id.'" />' ?>
									<?php } ?>
									<?php echo $service->name ?>
								</label>
								<?php if(!$service->onlyone) echo '<input style="width:30px;" id="s_'.$service->id.'" name="'.$service->id.'" class="spinner" type="text" value="1">'  ?>
							</div>
						</td>
						<td style="padding-right:3em">$<span class="cost"><?php echo $service->cost ?></span></td>
						<td><span class="cost"><?php echo $service->euro ?></span>€</td>
				   <tr>
				   <?php endforeach;?>
				   <tr class="success">
						<td style="padding-right:3em"><b>Total</b></td>
						<td style="padding-right:3em">$<b id="total">0</b></td>
						<td><b id="total_euros">0</b>€</td>
				   <tr>
			   </table>
		   </div>
		   <div class="form-group">
		    <div>
			  <table id="paper" class="table" width="100%">
			  <tr>
			    <td width="20%"><b>Paper ID</b></td>
			    <td width="80%"><b>Title</b></td>
			  </tr>
			  <tr >
			    <td ><input value="<?php echo set_value('paper_id1') ?>" type="text" name="paper_id1" class="form-control" id="paper_id1" ></td>
			    <td><input value="<?php echo set_value('paper_title1') ?>" type="text" name="paper_title1" class="form-control" id="paper_title1"></td>
			  </tr>
			  <tr>
			    <td><input value="<?php echo set_value('paper_id2') ?>" type="text" name="paper_id2" class="form-control" id="paper_id2" ></td>
			    <td><input value="<?php echo set_value('paper_title2') ?>" type="text" name="paper_title2" class="form-control" id="paper_title2"></td>
			  </tr>
			  </table>
		   </div>
		  </div>
		  <div class="form-group">
		    <div class="checkbox">
				<label class="checkbox">
				  <input name="accept" value="1" type="checkbox"> <?php echo lang("cimps_Permission"); ?> 
				</label>
			</div>
		  </div>
			<ul>
			  <li>CIMAT</li>
			  <li>IngSoft</li>
			  <li>COZCyT Zacatecas</li>
			  <li>SEZAC </li>
			  <li>Secretaría de Economía</li>
			  <li>Canacintra Zacatecas</li>
			  <li>everis</li>
			  <li>InnovaTiA</li>
			  <li>Softlogik</li>
			  <li>Aster</li>
			  <li>Cantera Software</li>
			  <li>zacsoft</li>
			  <li>Software Gurú</li>
			  <li>Emporio Zacatecas</li>
			  <li>La BONITA</li>
			 </ul>
		    <div>
		      <button type="submit" class="btn btn-default"><?php echo lang("cimps_Register"); ?></button>
		    </div>
	</form>
	</div>
	<div class="col-md-4">
					<h3><?php echo lang("cimps_Payment_Method"); ?></h3>
<pre><?php echo lang("cimps_Barralateralpago"); ?></pre>
          		</div>
	
	</div>
     




	<script>
		$(document).ready(function() {
			
			var total = 0;
			var totalEuros = 0;
			var s = new Array();
			
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
			
			if(idGroup != 2){
				$("#paper").hide();
			}
			
			if(idGroup == 3){
				total += 700;
				totalEuros += 50;
				$("#total").text(total);
				$("#total_euros").text(totalEuros);
			}else if(idGroup == 4){
				total += 350;
				totalEuros += 25;
				$("#total").text(total);
				$("#total_euros").text(totalEuros);
			}else if(idGroup == "2"){
						total += 3500;
						totalEuros += 240;
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
			}else if(idGroup == "5"){
						total += 1400;
						totalEuros += 100;
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
					}else if(idGroup == "11"){
						total += 350;
						totalEuros += 25;
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
					}
			
			
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
				$("#total").text(total);
				$("#total_euros").text(totalEuros);
				},  min: 1
				
				
			});
			
			$(".spinner").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });

		
			$("#group").change(function() {
				$('#services').html("Loading...");
			   $.get('<?php echo site_url("user/services_ajax"); ?>' + "/" + $(this).val(), function(data) {
				  $('#services').html(data);
				  $(".cost").digits();
					total = 0;
					totalEuros = 0;
					idGroup = $("#group").val();
					
					if(idGroup != 2){
						$("#paper").hide();
					}else{
						$("#paper").show();
					}
					
				    if(idGroup == "3"){
						total += 700;
						totalEuros += 50;
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
					}else if(idGroup == "4"){
						total += 350;
						totalEuros += 25;
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
					}else if(idGroup == "2"){
						total += 3500;
						totalEuros += 240;
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
					}else if(idGroup == "5"){
						total += 1400;
						totalEuros += 100;
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
					}else if(idGroup == "11"){
						total += 350;
						totalEuros += 25;
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
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
					$("#total").text(total);
					$("#total_euros").text(totalEuros);
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
				  if(servicio.onlyone){
					 total += servicio.cost;
					 totalEuros += servicio.euro;
					 
				  }else{
				     num = $("#s_" + $(this).val()).val();
					 
					 s[$(this).val()] = num;
					 total += servicio.cost * num;
					 totalEuros += servicio.euro * num;
				  }	
					
				}else{
				  if(servicio.onlyone){
				    total -= servicio.cost;
					totalEuros -= servicio.euro;
				  }else{
				    ns = s[$(this).val()];
					total -= servicio.cost * ns;
					totalEuros -= servicio.euro * ns;
					s[$(this).val()] = -1;
				  }
				}
				
				$("#total").text(total);
				$("#total_euros").text(totalEuros);
				
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
				$("#total_euros").text(totalEuros);
				$("#total").text(total);
				
			});
		    }
			
			
			
		});
	</script>
