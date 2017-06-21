<!--resgistro-->

<?php
	$v1 = $_GET['LoginFacebook'];
	
	if ($v1 == true){ ?>
		<script>

				var windowName = 'userConsole';
				var popUp = window.open('about:blank','_blank','width=1,height=1');
				if (popUp == null || typeof(popUp)=='undefined') {  
    				alert('Por favor deshabilita el bloqueador de ventanas emergentes y vuelve a refrescar la pagina (F5).');
				}
				else {  
 				   popUp.close();
				}



	  		(function(d, s, id) {
	    		var js, fjs = d.getElementsByTagName(s)[0];
	    		if (d.getElementById(id)) return;
	    		js = d.createElement(s); js.id = id;
	    		js.src = "//connect.facebook.net/en_US/sdk.js";
	    		fjs.parentNode.insertBefore(js, fjs);
	  		}(document, 'script', 'facebook-jssdk'));
	 	</script>
	 	

	<?php }

?>

	  <div style="margin:20px;"></div>
	  <div>
	  	<div>
	  		<h2 style="text-align: center"><strong><?php echo lang("cimps_Register"); ?></strong></h2>

<div style="margin-bottom: 40px;">
	<h5><?php echo lang("cimps_Required"); ?></h5>
	  		<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
	  		<form id="registrationFormInfo"  method="post" action="<?php if (isset($admin) &&  $admin)
	  		echo site_url('user/register/admin');
	  		else
	  			echo site_url('user/register'); ?>" role="form">
</div>
	  		

				<!--informacion personal-->
				<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF;">
					<div style="margin-left: -25px; margin-top: -25px;">
						<!--logo-->
						<img style=" width:50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_info_per.png" />
						<div style="margin: -35px 20px 0px 50px;">
							<label >
								<h3><?php echo lang("cimps_personal_info"); echo $_POST['LoginFacebook']; ?></h3>
							</label>
						</div> 
					</div> 
					<div style="margin-left: 35px; margin-right: 15px;">
						<div>
							<!--Titulo -->
							<label for="title" style="margin-right: 100px"><?php echo lang("cimps_Tittletag"); ?></label>
							<!--Nombre-->
							<label for="inputName"><?php echo lang("cimps_Nametag"); ?></label>
						</div>
						<div>
							<!--Titulo -->
							<?php echo form_dropdown('tittle', $tittle, set_value('tittle'), 'class="round" style="margin-right: 20px"'); ?>
							<!--Nombre-->
							
							<input id="NombreFB" value="<?php echo set_value('name')?>" name="name" type="text" class="round" placeholder="Name" style="width:600px">

								  				
						</div>
						<div>
							<!--Correo elctronico -->
							<label for="inputEmail" style="margin-right: 220px"><?php echo lang("cimps_Email_add");?></label>
							<!--Genero-->
							<label for="inputName"><?php echo lang("cimps_Gender"); ?></label>
						</div>
						<div>
							<!--Correo elctronico -->
							<input id="EmailFB" value="<?php echo set_value('email') ?>" type="email" name="email" class="round" id="inputEmail1" placeholder="Email" style="width: 300px; margin-right: 35px">
							<!--Genero-->
							<label>
								<input id="femaleFB" type="radio" name="gender" id="optionsRadios1" value="female" <?php if(set_value('gender') == "female") echo "checked" ?>>
								<?php echo lang("cimps_Female"); ?>
							</label>
							<label>
								<input id="maleFB" type="radio" name="gender" id="optionsRadios2" value="male" <?php if(set_value('gender') == "male") echo "checked" ?>>
								<?php echo lang("cimps_Male"); ?>
							</label>				
						</div>
					</div>
				</div>
				<!--/informacion personal-->


				<!--Procedencia del usuario -->
				<div style="border:2px solid #610303; border-radius: 25px; margin-top: 40px; background-color : #FFFFFF;">
					<div style="margin-left: -25px; margin-top: -25px;">
						<!--logo-->
						<img style=" width:50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_info_loc.png" />
					</div>
					<div style="margin: -35px 20px 0px 50px;">
						<label >
							<h3><?php echo lang("cimps_personal_location"); ?></h3>
						</label>
					</div> 
					<div style="margin-left: 40px; margin-right: 15px;">
						<div>
							<!--CIUDAD-->
							<label for="inputCity" style="margin-right: 330px"><?php echo lang("cimps_Citytag");?></label>
							<!--ESTADO-->
							<label for="inputCountry"><?php echo lang("cimps_Countrytag"); ?></label>
						</div>
						<div>
							<!--CIUDAD-->
							<input value="<?php echo set_value('city') ?>" name="city" type="text" class="round" placeholder="City" style="width: 350px; margin-right: 20px">
							<!--ESTADO-->
							<input value="<?php echo set_value('country') ?>" type="text" name="country" class="round" placeholder="Country" style="width: 350px">
						</div>
					</div>
				</div>
				<!--/Procedencia del usuario -->
	  		

				<!--informacion de la univercidad del usuario -->
				<div style="border:2px solid #610303; border-radius: 25px; margin-top: 40px; background-color : #FFFFFF;">
					<div style="margin-left: -25px; margin-top: -25px;">
						<!--logo-->
						<img style=" width:50px; height: 50px;" src="<?php echo base_url() ?>assets/img/logo_info_job.png" />
					</div>
					<div style="margin: -35px 20px 0px 50px;">
						<label >
							<h3><?php echo lang("cimps_personal_work"); ?></h3>
						</label>
					</div> 

					<div style="margin-left: 40px; margin-top: 0px; margin-right: 15px;">
						<div>
							<label for="inputAfilation1"><?php echo lang("cimps_Afiliationtag"); ?></label><br/>
							<div>
								<?php echo form_dropdown('reg_venue', $venues, set_value('reg_venue'), 'class="round" id="venue" style="width: 700px" '); ?>

								<input style="width: 700px" value="<?php echo ((intval(set_value('reg_venue'))==2) ? set_value('afiliation_name') : "I.T. Aguascalientes") ?>" type="text" name="afiliation_name" class="round" id="inputAfiliation" placeholder="Afiliation Name" <?php if(intval(set_value('reg_venue'))!=2) echo "readonly" ?>>

							</div>
						</div>
						<div>
							<label for="inputAfilation2"><?php echo lang("cimps_AfiliationAddresstag"); ?></label>
							<div>
								<input style="width: 700px" value="<?php echo set_value('afiliation_address') ?>" type="text" name="afiliation_address" class="round" id="inputAfiliation2" placeholder="Afiliation Address">
							</div>
						</div>

					</div>
				</div>


				<div style="border:2px solid #610303; border-radius: 25px; margin-top: 40px; background-color : #FFFFFF;">

					<div style="margin-left: -25px; margin-top: -25px;">
						<!--logo-->
						<img style=" width:50px; height: 50px;" src="<?php echo base_url() ?>assets/img/logo_info_job.png" />
					</div>
					<div style="margin: -35px 20px 0px 50px;">
						<label >
							<h3><?php echo lang("cimps_personal_work"); ?></h3>
						</label>
					</div> 


				<div style="margin-left: 40px; margin-right: 40px">





					<div class="form-group">
						<label for="title"><?php echo set_value('cimps_Register_Profile') ?></label>
						<div>
							<?php echo form_dropdown('registre_porfile', $groups, set_value('registre_porfile'), 'class="round" id="group"'); ?>
						</div>
					</div>
					<div class="form-group" id="contenedor_matricula">
						<label for="inputControlNum"><?php echo lang("cimps_Control_Numtag"); ?></label>
						<div>
							<input value="<?php echo set_value('control_num') ?>" name="control_num" id="control_num" type="text" maxlength="12" name="control_num" class="round" placeholder="ControlNum">						
						</div>
					</div>
					<div class="form-group" id="contenedor_tallas">
						<label for="inputShirtSize"><?php echo lang("cimps_Shirt_Size"); ?></label>
						<div>
							<?php echo form_dropdown('shirt_size', $sizes, set_value('shirt_size'), 'class="round" id="size"'); ?>
						</div>
					</div>
					<div class="form-group" id="contenedor_codigo">
						<label for="inputAccessCode"><?php echo lang("cimps_Access_Codetag"); ?></label>
						<div>
							<input value="<?php echo set_value('access_code') ?>" name="access_code" id="access_code" type="password" maxlength="25" name="access_code" class="round" placeholder="AccessCode">
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
													<td style="padding-right:3em">
														$<b id="total">0</b>
													</td>
													<td><b id="total_euros">0</b>€</td>
													<tr>
													</table>
												</div>
												<div class="form-group">
													<div>
														<table id="paper" class="table" width="100%">
															<tr>
																<td width="20%"><b>Paper ID*</b></td>
																<td width="80%"><b>Title* (at least one)</b></td>
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
													<li>Among Others</li>
												</ul>
					</div>
				</div>

<br>







												<div class="col-md-4">
													<button class="btn btn-primary btn-md btn-block style=" margin-left:-15px; " type="submit"><?php echo lang("cimps_Register"); ?></button>

												</div>
											</form>
										</div>
									

	<!-- div class="col-md-4">
					<h3><?php echo lang("cimps_Payment_Method"); ?></h3>
<pre><?php echo lang("cimps_Barralateralpago"); ?></pre>
</div -->
<br>
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

		$('#venue').on('change', function() {
			idVenue = $(this).val();

			if (idVenue != 1) {
				$('#inputAfiliation').val('');
				$('#inputAfiliation').attr('readonly',false);
				$('#inputAfiliation').focus();
			} else {
				$('#inputAfiliation').val('I.T. Aguascalientes');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').focus();
			}

			idGroup = $("#group").val();

			if(idGroup != 4 || (idGroup == 4 &&  idVenue != 1)){
				$("#contenedor_matricula").hide();
			}else{
				$("#contenedor_matricula").show();
			}

			   //Si pagan
			   if(idGroup!=6 && idGroup!=7 && idGroup!=8 && idGroup!=9 && idGroup!=10){
			   	$("#contenedor_codigo").hide();
			   } else {
			   	$("#contenedor_codigo").show();
			   }
			});

		$(".cost").digits();

		var services = new Array();
		<?php foreach ($services as $service):?>
		services[<?php echo $service->id ?>] = {cost:<?php echo $service->cost ?>,euro:<?php echo $service->euro ?>,onlyone:<?php echo $service->onlyone ?>};
	<?php endforeach;?>

	idGroup = $("#group").val();
	idVenue = $("#venue").val();

	if(idGroup != 2){
		$("#paper").hide();
	}

	if(idGroup != 4 || (idGroup == 4 &&  idVenue != 1)){
		$("#contenedor_matricula").hide();
	}

	if(idGroup != 4){
		$("#contenedor_tallas").hide();
	}

	if(idGroup!=6 && idGroup!=7 && idGroup!=8 && idGroup!=9 && idGroup!=10){
		$("#contenedor_codigo").hide();
	}

			if(idGroup == 3){  //General Public
				total += 700;
				totalEuros += 40;
				//$("#total").text(numeral(total).format('0,0'));
				//$("#total_euros").text(numeral(totalEuros).format('0,0'));
				$("#total").text(total);
				$("#total_euros").text(totalEuros);
			}else if(idGroup == 4){  //Students
				total += 300;
				totalEuros += 20;
				//$("#total").text(numeral(total).format('0,0'));
				//$("#total_euros").text(numeral(totalEuros).format('0,0'));
				$("#total").text(total);
				$("#total_euros").text(totalEuros);
			}else if(idGroup == "2"){  //Author
				total += 5500;
				totalEuros += 285;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
			}else if(idGroup == "5"){  //Companies/Enterprise not sponsors
				total += 1500;
				totalEuros += 80;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}else if(idGroup == "11"){  //Poster
						total += 700;
						totalEuros += 50;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
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
				//$("#total").text(numeral(total).format('0,0'));
              			//$("#total_euros").text(numeral(totalEuros).format('0,0'));
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
              				    		idVenue = $('#venue').val();
              				    		idGroup = $("#group").val();

              				    		if(idGroup != 2){
              				    			$("#paper").hide();
              				    		}else{
              				    			$("#paper").show();
              				    		}

              				    		if(idGroup != 4 || (idGroup == 4 &&  idVenue !=1)){
              				    			$("#contenedor_matricula").hide();
              				    		}else{
              				    			$("#contenedor_matricula").show();
              				    			$("#control_num").focus();
              				    		}

              				    		if(idGroup != 4){
              				    			$("#contenedor_tallas").hide();
              				    		}else{
              				    			$("#contenedor_tallas").show();
              				    		}

              				    		if(idGroup!=6 && idGroup!=7 && idGroup!=8 && idGroup!=9 && idGroup!=10){
              				    			$("#contenedor_codigo").hide();
              				    		} else {
              				    			$("#contenedor_codigo").show();
              				    			$('#access_code').focus();
              				    		}

				    if(idGroup == "3"){  //General Public
				    	total += 700;
				    	totalEuros += 40;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}else if(idGroup == "4"){  //Students
						total += 300;
						totalEuros += 20;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}else if(idGroup == "2"){  //Author
						total += 5500;
						totalEuros += 285;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}else if(idGroup == "5"){  //Companies/Enterprise not sponsors
						total += 1500;
						totalEuros += 80;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}else if(idGroup == "11"){  //Poster
						total += 700;
						totalEuros += 50;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
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
					//$("#total").text(numeral(total).format('0,0'));
            			        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
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

				//($("#total").text(numeral(total).format('0,0'));
           		        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
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
             		        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
				//$("#total").text(numeral(total).format('0,0'));
				$("#total_euros").text(totalEuros);
				$("#total").text(total);
			});
	  }



	});




var facebookLogin = function() {
      checkLoginState(function(data) {
        if (data.status !== 'connected') {
          FB.login(function(response) {
            if (response.status === 'connected')
              getFacebookData();
          }, {scope: scopes});
        }
      })
    }
</script>
