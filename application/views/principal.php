<!--resgistro-->

			<!--verifica si estan blokeadas las ventanas emergentes-->					
			<script type="text/javascript">
				var windowName = 'userConsole';
				var popUp = window.open('about:blank','_blank','width=1,height=1');
				if (popUp == null || typeof(popUp)=='undefined') {  
					alert('Por favor deshabilita el bloqueador de ventanas emergentes y vuelve a refrescar la pagina (F5).');
				}
				else {  
					popUp.close();
				}

			</script>
			<!--/verifica si estan blokeadas las ventanas emergentes-->	
			<!--varaibles boleanas que bienen de login -->
			<?php
			$v1 = $_GET['LoginFacebook'];
			$v2 = $_GET['LoginGoogle'];

			if ($v1 == true){ ?>
			<!--incio con facebook -->
			<script>

				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_US/sdk.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));

				
			</script>


			<?php } elseif ($v2 == true) { ?>

			<!--inicio con google cuenta ligada a iscrodma@gmail.com-->
			<meta name="google-signin-clientid" content="1093837043328-9664stilbogjtv6muiomom2r9qecn5fl.apps.googleusercontent.com" />
			<meta name="google-signin-scope" content="https://www.googleapis.com/auth/plus.login" />
			<meta name="google-signin-requestvisibleactions" content="http://schema.org/AddAction" />
			<meta name="google-signin-cookiepolicy" content="single_host_origin" />
			<!---->
			<script>
				var val = 0;
				var additionalParams = {
					'callback': signinCallback
				};
				(function() {
					var po = document.createElement('script');
					po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/client:plusone.js?onload=render';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(po, s);
				})();

				/* Executed when the APIs finish loading */
				function render() {

						   // Additional params including the callback, the rest of the params will
						   // come from the page-level configuration.
						   gapi.auth.signIn(additionalParams);
						   // Attach a click listener to a button to trigger the flow.
						   
						}

						function signinCallback(authResult) {
							if (authResult['status']['signed_in']) {

								getInfo();
								

							} else {	
								val=0;						
								gapi.auth.signIn(additionalParams);
							}
						}
						function getInfo(){
							gapi.client.load('oauth2', 'v2', function() {
							gapi.client.oauth2.userinfo.get().execute(function(resp) {
						    NombreFB.value=resp.name;
						   	EmailFB.value=resp.email;
							EmailC.value=resp.email;

						    ImgPefil.src=resp.picture;
						    
						    div = document.getElementById('exit');
            				div.style.display = '';

            				

						    if (resp.gender === 'male'){
						    	$("#maleFB").prop("checked", true);
						    }else{
						    	$("#femaleFB").prop("checked", true);
						    }	


						    function validar_email( email ) 
							{
    							var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    							return regex.test(email) ? true : false;
							}

							if (validar_email( resp.email )){
            					document.getElementById("EmailFB").disabled = true;
								document.getElementById("EmailC").disabled = true;
            					document.getElementById("city").focus();
            				}else{
            					document.getElementById("EmailFB").value="";
								document.getElementById("EmailC").value="";
            					document.getElementById("EmailFB").focus();
            				}	



								alert("¡¡Bienvenido!! \n \n Por favor de completar los campos requeridos. \n \n *Nota: si se queda la ventana de Google abierta, favor de cerrar y refrescar la pagina (F5).");					
						

		

            				 

						})

							});


								
						}

						
					</script>
					<script type="text/javascript">
						function signOut() {
							var popUp = window.open('https://accounts.google.com/logout','https://accounts.google.com/logout','width=450, height=750');
														
							if (popUp == null || typeof(popUp)=='undefined') {  
								alert('Por favor deshabilita el bloqueador de ventanas emergentes y vuelve a refrescar la pagina (F5).');
								}
							else {  
								location.href="http://cimps.cimat.mx/registro/";
								
							}
						}
					</script>
					<script src="https://www.google.com/recaptcha/api.js" async defer></script>

					<!--finaliza registro con redes sociales-->
					<?php }

					?>
					


					<div id="exit" style="text-align: right; display:none;">
						<img id="ImgPefil" style=" width:50px; height: 50px "  src="" />
						<a href="#" onclick="signOut();">Sign out</a>
					</div>

	  <div style="margin:20px;"></div>
	  <div>
	  	<div>
			<p style="text-align: right"><a  href="http://cimps.cimat.mx/registro/"><strong><?php echo lang("cimps_back_Login"); ?></strong></a></p> 
	  		<h2 style="text-align: center"><strong><?php echo lang("cimps_Register"); ?></strong></h2>
		<div style="display: inline;">
			<div>
				<span><strong><?php echo lang("cimps_Required"); ?></strong></span> 
			</div> 
			 
		</div></br>
	  		<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
	  		<form id="registrationFormInfo" method="post"  role="form">

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
							<div><label for="title" style="margin-right: 100px"><?php echo lang("cimps_Tittletag"); ?></label></div> 
							<!--Nombre-->
							<div><label for="inputName"><?php echo lang("cimps_Nametag"); ?></label></div> 
						</div>
						<div>
							<!--Titulo -->
							<?php echo form_dropdown('tittle', $tittle, set_value('tittle'), 'class="round" style="margin-right: 20px"'); ?>
							<!--Nombre-->
							
							<input id="NombreFB" value="<?php echo set_value('name')?>" name="name" type="text" class="round" placeholder="Name" style="width:600px" required>

								  				
						</div>
						<div>
							<!--Correo electronico -->
							<label for="inputEmail1" style="margin-right: 295px"><?php echo lang("cimps_Email_add");?></label>
							<!--Correo electronico -->
							<label for="inputEmailConf" style="margin-right: 70px"><?php echo lang("cimps_Confirm_Email_add");?></label>
						</div>
						<div>
							<input id="EmailFB" value="<?php echo set_value('email') ?>" type="email" name="email" class="round" id="inputEmail1" placeholder="Email" style="width:350px; margin-right: 35px" required>
							<!--Confirmar Correo electronico -->
							<input id="EmailC" value="<?php echo set_value('emailConf') ?>" type="email" name="emailConf" class="round" id="inputEmailConf" placeholder="Email Confirmation" style="width: 350px; margin-right: 35px" required>
							
						</div>
						<div>
							<!--Genero-->
							<label for="inputName"><?php echo lang("cimps_Gender"); ?></label>
						</div>
						<div>
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
							<input id="city" value="<?php echo set_value('city') ?>" name="city" type="text" class="round" placeholder="City" style="width: 350px; margin-right: 20px" required>
							<!--ESTADO-->
							<input value="<?php echo set_value('country') ?>" type="text" name="country" class="round" placeholder="Country" style="width: 350px" required>
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

								<input style="width: 700px" value="<?php echo ((intval(set_value('reg_venue'))==2) ? set_value('afiliation_name') : "") ?>" type="text" name="afiliation_name" class="round" id="inputAfiliation" placeholder="Afiliation Name" <?php if(intval(set_value('reg_venue'))!=2) ?> required>

							</div>
						</div>
						<div>
							<label for="inputAfilation2"><?php echo lang("cimps_AfiliationAddresstag"); ?></label>
							<div>
								<input style="width: 700px" value="<?php echo set_value('afiliation_address') ?>" type="text" name="afiliation_address" class="round" id="inputAfiliation2" placeholder="Afiliation Address" required>
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
							<h3><?php echo lang("cimps_personal_setting"); ?></h3>
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
					<!--<div class="form-group" id="contenedor_tallas">
						<label for="inputShirtSize"><?php echo lang("cimps_Shirt_Size"); ?></label>
						<div>
							<?php echo form_dropdown('shirt_size', $sizes, set_value('shirt_size'), 'class="round" id="size"'); ?>
						</div>
					</div>-->
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
													<label id="label<?php echo $service->id?>" >
														<?php if(!$service->marked){ ?>
														<input name="cb<?php echo $service->id ?>" class="service input<?php echo $service->id ?>" type="checkbox" value="<?php echo $service->id ?>" >
														<?php echo $service->name ?>
														<?php }else{ ?>
														<input class="service input<?php echo $service->id ?>" type="checkbox" value="<?php echo $service->id ?>" checked disabled>
														<?php echo '<input type="hidden" name="cb'.$service->id.'" value="'.$service->id.'" />' ?>
														<b><?php echo $service->name ?> </b>
														<?php } ?>
														
													</label>
													<?php if(!$service->onlyone) echo '<input style="width:30px;" id="s_'.$service->id.'" name="'.$service->id.'" class="spinner" type="text" value="1">'  ?>
													</div>
												</td>
												<?php if($service->id == "11"){ ?>
													<td style="padding-right:3em"><span class="cost"><?php echo $service->cost ?></span> %</td>
												<?php }else{ ?>
													<td style="padding-right:3em">$<span class="cost"><?php echo $service->cost ?></span></td>
												<?php } ?>
												<?php if($service->id == "11"){ ?>
													<td><span class="cost"><?php echo $service->euro ?></span> %</td>
												<?php }else{ ?>
													<td><span class="cost"><?php echo $service->euro ?></span>€</td>
												<?php } ?>
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
												
												<div style="margin-left: 5px; margin-right: 15px;">
													<div>
														<div><label for="title" style="margin-right: 100px">* Prices valid until September 30</label></div> 
													</div>
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
															<input name="accept" value="1" type="checkbox" checked> <?php echo lang("cimps_Permission"); ?> 
														</label>
													</div>
												</div>
												<ul>
													<li>CIMAT</li>
													<li>IngSoft</li>
													<li>IEEE Xplore</li>
													<li>SPRINGER </li>
													<li>Among Others</li>
												</ul>
					</div>
				</div>

<br>





												<!--6Lf_5icUAAAAAKJs_6JPoDDVtZRmbzd7dgtv35Sr-->
												<div style="margin-bottom: 20px;" id='recaptcha' class="g-recaptcha" data-sitekey="6Lcjz9YhAAAAAJA3VJnoI6Wbp-ISlPyavT-zSxKA" data-callback="onSubmit"></div>


												<div id="Rcp" class="col-md-4" style="display: none;">


													
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
  function onSubmit(token) {
    div = document.getElementById('Rcp');
    div.style.display = '';
   
  }

  function validate(event) {
    event.preventDefault();
    if (!document.getElementById('field').value) {
      alert("You must add text to the required field");
    } else {
    alert("")
      grecaptcha.execute();
    }
  }

  function onload() {
    var element = document.getElementById('submit');
    element.onclick = validate;
  }
</script>



<script>
	$(document).ready(function() {

		var total = 0;
		var iva = false;
		var totalEuros = 0;
		var s = new Array();

		$.fn.digits = function(){ 
			return this.each(function(){ 
				$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
			})
		}

		$('#venue').on('change', function() {
			idVenue = $(this).val();

			if (idVenue == 0) {
				$('#inputAfiliation').val('');
				$('#inputAfiliation').attr('readonly',false);
				$('#inputAfiliation').focus();
				$('#inputAfiliation2').val('');
			} else if(idVenue == 1) {
				$('#inputAfiliation').val('Instituto Nacional De Estadística Y Geograf� 2a');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Av. Héroe De Nacozari Sur 2301 Fracc. Jardines Del Parque C.P. 20276');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 2) {
				$('#inputAfiliation').val('Instituto Tecnológico De Aguascalientes');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Av. Adolfo López Mateos #1801 Ote. Fracc. Bona Gens C.P. 20256 Aguascalientes Aguascalientes México.');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 3) {
				$('#inputAfiliation').val('Instituto Tecnológico eD Le�n');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Industrial Julian de Obregon, C.P. 37290 Le�n, Gto.');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 4) {
				$('#inputAfiliation').val('Instituto Tecnológico De Orizaba');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 5) {
				$('#inputAfiliation').val('Instituto Tecnológico De Zacatecas');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Carretera Panamericana S/N Crucero A Guadalajara Zacatecas Zac.');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 6) {
				$('#inputAfiliation').val('Universidad Autónoma De Yucatán');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 7) {
				$('#inputAfiliation').val('Universidad Católica Del Norte');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 8) {
				$('#inputAfiliation').val('Universidad De Atacama');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 9) {
				$('#inputAfiliation').val('Universidad Politécnica De Aguascalientes');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 10) {
				$('#inputAfiliation').val('Universidad Politécnica De Zacatecas');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 11) {
				$('#inputAfiliation').val('Universidad Veracruzana');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 12) {
				$('#inputAfiliation').val('Centro De Bachillerato Tecnológico Industrial Y De Servicios No. 168');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Rio Rhin S/N Frac. Colinas Del Rio Aguascalientes, Ags.');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 13) {
				$('#inputAfiliation').val('Centro De Investigación En Matemáticas, A. C. Unidad Aguascalientes');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 14) {
				$('#inputAfiliation').val('Centro De Investigación En Matemáticas, A. C. Unidad Guanajuato');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 15) {
				$('#inputAfiliation').val('Centro De Investigación En Matemáticas, A.C. Unidad Zacatecas');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Av. Universidad # 222 Fraccionamiento La Loma C.P. 98068 Zacatecas Zac.');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 16) {
				$('#inputAfiliation').val('Centro Universitario de Ciencias Exactas e Ingenierías');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Boulevard Marcelino García Barragán 1421, Olímpica, 44430 Guadalajara, Jal.');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 17) {
				$('#inputAfiliation').val('Centro Universitario de Ciencias Económico-Administrativas');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Periférico Norte N° 799, Núcleo Universitario Los Belenes, 45100 Zapopan, Jal.');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 18) {
				$('#inputAfiliation').val('Centro Universitario de los Valles');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Carretera Guadalajara - Ameca Km. 45.5, C.P. 46600, Ameca, Jalisco, México.');
				$('#inputAfiliation2').focus();
			}else if(idVenue == 19) {
				$('#inputAfiliation').val('Centro Universitario de Tonalá');
				$('#inputAfiliation').attr('readonly',true);
				$('#inputAfiliation2').val('Av. Nuevo Periférico 555, Ejido San José Tatepozco, 45425 Tonalá, Jal.');
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
				total += 900;
				totalEuros += 42;
				//$("#total").text(numeral(total).format('0,0'));
				//$("#total_euros").text(numeral(totalEuros).format('0,0'));
				$("#total").text(total);
				$("#total_euros").text(totalEuros);
			}else if(idGroup == 4 && 12){  //Students
				total += 500;
				totalEuros += 30;
				//$("#total").text(numeral(total).format('0,0'));
				//$("#total_euros").text(numeral(totalEuros).format('0,0'));
				$("#total").text(total);
				$("#total_euros").text(totalEuros);
			//}else if(idGroup == 12){  //Students  tec Leon
			//	total += 150;
			//	totalEuros += 7;
				//$("#total").text(numeral(total).format('0,0'));
				//$("#total_euros").text(numeral(totalEuros).format('0,0'));
			//	$("#total").text(total);
			//	$("#total_euros").text(totalEuros);
			}else if(idGroup == "2"){  //Author
				total += 6900;
				totalEuros += 340;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
			}else if(idGroup == "5"){  //Companies/Enterprise not sponsors
				total += 750;
				totalEuros += 38;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}//else if(idGroup == "11"){  //Poster
					//	total += 700;
					//	totalEuros += 50;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				//        $("#total").text(total);
              				//        $("#total_euros").text(totalEuros);
              				//    }


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
				    	total += 900;
				    	totalEuros += 42;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}else if(idGroup == "4" && "12"){  //Students
						total += 500;
						totalEuros += 30;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
              				}else if(idGroup == "11"){  // Professors
						total += 800;
						totalEuros += 38;
						//$("#total").text(numeral(total).format('0,0'));
						//$("#total_euros").text(numeral(totalEuros).format('0,0'));
						$("#total").text(total);
						$("#total_euros").text(totalEuros);
					}else if(idGroup == "2"){  //Author
						total += 6900;
						totalEuros += 340;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}else if(idGroup == "5"){  //Companies/Enterprise not sponsors
						total += 750;
						totalEuros += 38;
						//$("#total").text(numeral(total).format('0,0'));
              				        //$("#total_euros").text(numeral(totalEuros).format('0,0'));
              				        $("#total").text(total);
              				        $("#total_euros").text(totalEuros);
					}else if(idGroup == "13"){  //Asistente virtual
						total += 300;
						totalEuros += 20;
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
								//$( "input[name='cb1']" ).wrap( "<strong></strong>" );
              				});
	});


	  changeCheckbox();
	  changeInput();

	  function changeCheckbox(){
	  	$('.service').change(function(){

	  		servicio = services[$(this).val()]

	  		if(this.checked){
				if (servicio.cost == 0.16) {
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
				if (servicio.cost == 0.16) {
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
           		$("#total_euros").text(numeral(totalEuros).format('0,0'));
           		        //$("#total").text(total);
           		        //$("#total_euros").text(totalEuros);
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

	function checkEmail() {
		var emailC = document.getElementById('EmailC');
		var emailFB = document.getElementById('EmailFB');
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if (!filter.test(emailC.value)) {
			alert('Please provide a valid email address');
			emailC.focus;
			return false;
		}
		if (!filter.test(emailFB.value)) {
			alert('Please provide a valid email address');
			emailFB.focus;
			return false;
		}

		if (emailC.value.toLowerCase() !== emailFB.value.toLowerCase()) {
			alert('Please provide the equal email address');
			emailFB.focus;
			return false;
		}
	}

	let myInput = document.getElementById('EmailC');
	
	myInput.addEventListener('blur', () => {
		//console.log("entre...")
		//clearTimeout(typingTimer);
		if(myInput.value) {
			//typingTimer = setTimeout(doneTyping, doneTypingInterval);
			//doneTyping();
			checkEmail();
		}
	});


	
	$("#paper_id2").hide();
	$("#paper_title2").hide();
	
	//$("input[name='cb2']").live("click", function() {
	$(document).on("click","input[name='cb2']", function() {
		let isChecked = $("input[name='cb2']").is(':checked')
		if(isChecked) {
			$("#paper_id2").show();
			$("#paper_title2").show();
		}else{
			$("#paper_id2").hide();
			$("#paper_title2").hide();
		}
	});


});

</script>
