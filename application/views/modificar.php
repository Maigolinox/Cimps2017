 <!--clase pricipal de User Informacion-->
 <!--Menu-->
 <ul class="nav nav-justified">
    <li>
        <a  href="http://cimps.cimat.mx/registro/index.php/user/" >
            <img  src="<?php echo base_url() ?>assets/img/logo_home.png" style="width:30px;height:30px; margin: -30px -30px -30px -30px;">
        </a>
    </li>

   <!-- <?php if(isset($admin) && $admin) { ?>
   <li><a href="http://srcimps.cimat.mx:8080/cimatcimps/web/index.php?correo=<?php echo set_value('email', $user->email) ?>&key=<?php echo md5('GiUt@*q564h85m&'.set_value('email', $user->email)) ?>"target="_blank">INSCRIPCIÓN A CONFERENCIAS, 
        SESIONES Y TALLERES</a></li>
    <?php } ?>-->

<?php if($user_group != 13 && $accepted || $user->email == "admin@cimat.mx") { ?>
   <li><a href="http://srcimps.cimat.mx:8080/cimatcimps/web/index.php?correo=<?php echo set_value('email', $user->email) ?>&key=<?php echo md5('GiUt@*q564h85m&'.set_value('email', $user->email)) ?>"target="_blank">
   INSCRIPCIÓN A CONFERENCIAS</a></li>
    <?php }?>
    <?php if($user_group == 13 && $accepted || $user->email == "admin@cimat.mx") { ?>
        <li><a href="http://srcimps.cimat.mx:8080/cimatcimps/web/index.php?r=programa-virtual&correo=<?php echo set_value('email', $user->email) ?>&key=<?php echo md5('GiUt@*q564h85m&'.set_value('email', $user->email)) ?>"target="_blank">
   INSCRIPCIÓN A CONFERENCIAS (Virtual)</a></li>
    <?php } ?>

    <li></li>
    <!--<li><a href="http://cimps.cimat.mx/registration_system/index.php/user/"><?php echo lang("cimps_MenuHome"); ?></a></li>-->
    <li class="active" ><a href="<?php echo site_url('user/information'.$url_crud_id) ?>"><?php echo lang("cimps_MenuUpdate"); ?></a></li>
    <?php if($user->gaffete==1 && $user->accept==1) { ?>
      <!-- <li><a href="<?php echo site_url('descargas/constanciaPDF'); ?>">Download your constance!</a></li>-->
    <?php } ?>
    <!--<?php if($user->gaffete==1) { ?>-->
      <!--<li><a href="http://srcimps.cimat.mx:8080/cimatcimps/web/index.php?correo=<?php echo set_value('email', $user->email) ?>&key=<?php echo md5('GiUt@*q564h85m&'.set_value('email', $user->email)) ?>"target="_blank">INSCRIPCIÓN A CONFERENCIAS, 
SESIONES Y TALLERES</a></li>-->
    <!--<?php } ?>-->
    
    <li><a href="<?php if (isset($admin) && $admin)
        echo site_url('payment/index'.$url_crud_id);
        else 
            echo site_url('payment'); ?>"><?php echo lang("cimps_MenuAdd"); ?></a></li>

        <!--REGISTRO DE CURSO-->
	<li><a href="http://cimps.cimat.mx/contact-information/" target="_blank"><?php echo lang("cimps_MenuContact"); ?>
            
        </a></li>
        <!--<li><a href="<?php echo site_url('auth/logout') ?>"><?php echo lang("cimps_MenuLogout"); ?></a></li>-->
    </ul>
    <!--Menu-->


    <!--separacion entre el titulo y cajas-->
    <div style="margin:20px;"></div>

    <div>
      <div>
       <?php if($succesfull){ ?>
       <div class="alert alert-success">
        <?php echo lang("cimps_Message"); ?>
    </div>
    <?php } ?>
    <!-- <a class="btn btn-primary" href="<?php // echo site_url('descargas/constanciaPDF'); ?>">Descargar constancia de asistencia en PDF</a> -->


<!--contenido de informacion de usuario-->
<h2 style="text-align: center"><?php echo lang("cimps_user_information"); ?></h2> <!--titulo-->

<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<?php echo (!empty($message)) ? '<div class="alert alert-success">'.$message.'</div>' : ""; ?>
<form method="post" action="<?php
if (isset($admin) && $admin)
 echo site_url('user/update/'.$crud_user_id);
else 
 echo site_url('user/update');
?>" role="form">

<!--informacion personal del usuario -->
<div style="border:2px solid #610303; border-radius: 25px; background-color : #FFFFFF;">
    <div style="margin-left: -25px; margin-top: -25px;">
     <!--logo-->
     <img style=" width:50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_info_per.png" />
     <div style="margin: -35px 20px 0px 50px;">
          <label >
            <h3><?php echo lang("cimps_personal_info"); ?></h3>
          </label>
      </div> 
 </div>        							
 <div style="margin-left: 35px; margin-right: 15px;">
     <label for="title"><?php echo lang("cimps_Tittletag"); ?></label> <!--etiqueta de Titulo-->
     <label for="inputName" style="margin-left: 100px;"><?php echo lang("cimps_Nametag"); ?></label> <!--etiqueta de nombre -->
     <label for="inputName" style="margin-left: 270px;"><?php echo lang("cimps_perfil"); ?></label><!--etiqueta de perfil-->
     <div>
      <?php echo form_dropdown('tittle', $tittle, set_value('tittle', $user->tittle), 'class="round"'); ?> <!--lista de titulos-->
      <input value="<?php echo set_value('name', $user->name) ?>" name="name" type="text" class="round" style= "margin-left: 20px; margin-right: 10px; width: 500px;"  placeholder="Name" > <!--caja de texto de nombre-->
      <?php echo form_dropdown('registre_porfile', $groups, set_value('registre_porfile', $user_group),  'class="round" style="width:250px;" id="group"  disabled'); ?>
  </div>      									
</div>
<div style="margin-left: 35px; margin-top: 5px; margin-right: 15px;">
 <label for="inputEmail" style="margin-right: 125px;"><?php echo lang("cimps_Email_add"); ?></label> <!--etiqueta de titulo-->
 <!--<label for="inputShirtSize" style="margin-left: 120px;"><?php echo lang("cimps_Shirt_Size"); ?></label> etiquera de tamanio de camisa-->
 <label for="inputName" style="margin-left: 120px;"><?php echo lang("cimps_Gender"); ?></label>

 <div>
  <input  value="<?php echo set_value('email', $user->email) ?>" type="email" name="email" class="round" id="inputEmail1" placeholder="Email" style="width: 300px;" > <!-- caja de texto de el correro electronico-->
 <!-- <?php echo form_dropdown('shirt_size', $sizes, set_value('shirt_size', $user->shirt_size), 'class="round" style="margin-left: 60px;"   id="size"'); ?>lista depegable de el tamanio de camisa-->
  <label style="margin-left: 70px;">
   <input type="radio" name="gender" id="optionsRadios1" value="female" <?php if(set_value('gender', $user->gender) == "female") echo "checked" ?>>
   <?php echo lang("cimps_Female"); ?>
</label>

<label>
   <input type="radio" name="gender" id="optionsRadios2" value="male" <?php if(set_value('gender', $user->gender) == "male") echo "checked" ?>>
   <?php echo lang("cimps_Male"); ?>
</label>        															
</div>
<?php if($user->gaffete==1 && $user->accept==1) { ?>
<div>
  <label>Clave de descuento: CIMPS</label>
</div>
<?php } ?>
</div>        								
</div>
<!--/informacion personal del usuario -->

<!--Procedencia del usuario -->
<div style="border:2px solid #610303; border-radius: 25px; margin-top: 40px; background-color : #FFFFFF;">
    <div style="margin-left: -25px; margin-top: -25px;">
     <!--logo-->
     <img style=" width:50px; height: 50px": src="<?php echo base_url() ?>assets/img/logo_info_loc.png" />
     <div style="margin: -35px 20px 0px 50px;">
          <label >
            <h3><?php echo lang("cimps_personal_location"); ?></h3>
          </label>
      </div> 
 </div> 
 <div style="margin-left: 40px; margin-right: 15px;">
     <label for="inputCity" ><?php echo lang("cimps_Citytag"); ?></label>
     <label for="inputCountry" style="margin-left: 325px;"><?php echo lang("cimps_Countrytag"); ?></label>
 </div>
 <div style=" margin-left: 40px;">
     <input value="<?php echo set_value('city', $user->city) ?>" name="city" type="text" class="round" style="width: 350px;" placeholder="City">
     <input value="<?php echo set_value('country', $user->country) ?>" type="text" name="country" class="round" style="width: 350px;  margin-left: 20px;" placeholder="Country">
 </div>
</div>
<!--/procedencias del usuario -->


<!--informacion personal de la univercidad del usuario -->
<div style="border:2px solid #610303; border-radius: 25px; margin-top: 40px; background-color : #FFFFFF;">
    <div style="margin-left: -25px; margin-top: -25px;">
     <!--logo-->
     <img style=" width:50px; height: 50px;" src="<?php echo base_url() ?>assets/img/logo_info_job.png" />
          <div style="margin: -35px 20px 0px 50px;">
          <label >
            <h3><?php echo lang("cimps_personal_work"); ?></h3>
          </label>
      </div> 
 </div> 
 <div style="margin-left: 40px; margin-top: 0px; margin-right: 15px;">
     <label for="inputAfilation1"><?php echo lang("cimps_Afiliationtag"); ?></label>   									
 </div>
 <div style=" margin-left: 40px;">        									
     <input value="<?php echo set_value('reg_venue', $user->reg_venue) ?>" type="hidden" name="reg_venue" id="regVenue">
     <input value="<?php echo set_value('afiliation_name', $user->afiliation_name) ?>" type="text" name="afiliation_name" class="round" style=" width: 700px;" id="inputAfiliation" placeholder="Afiliation Name" <?php if(intval($user->reg_venue)!=2) echo "readonly" ?>> 
 </div>       									
 <div style="margin-left: 40px;">
     <label for="inputAfilation2"><?php echo lang("cimps_AfiliationAddresstag"); ?></label>
 </div>
 <div style="margin-left: 40px;">
     <input value="<?php echo set_value('afiliation_address', $user->afiliation_adress) ?>" type="text" name="afiliation_address" class="round" style="width: 700px;" id="inputAfiliation2" placeholder="Afiliation Address" readonly=true; >

 </div>
</div>
<!--/informacion personal de la univercidad del usuario -->


<!--id="contenedor_matricula" oculta una matricula revizar el codigo-->

<div class="form-group" id="contenedor_matricula" style="border:2px solid #610303; border-radius: 25px; margin-top: 40px; background-color : #FFFFFF;" >
   <div style="margin-left: 40px; margin-top: 0px; margin-right: 15px;">
    <label for="inputControlNum"><?php echo lang("cimps_Control_Numtag"); ?></label>
    <div><input value="<?php echo set_value('control_num', $user->control_num) ?>" name="control_num" type="text" maxlength="12" name="control_num" class="round" placeholder="ControlNum"></div>
</div>
</div>
                    <br>

        						  <div class="form-group">
                        <label for="title"><?php echo set_value('cimps_Register_Profile') ?></label>
                      </div>

        							<div class="col-md-3">
                         <button type="submit" class="btn btn-default"> <?php echo lang("cimps_update_information");?> </button>
        								
        							</div>

        							        </form>
                              <div class="col-md-3">
                                <a href="<?php
                                if (isset($admin) && $admin)
                                 echo site_url('p/index/'.$crud_user_id);
                             else 
                                 echo site_url('p');
                             ?>" class="btn btn-primary btn-md btn-block" style="margin-left:-15px;"><?php echo lang("cimps_change"); ?>

                         </a>
                     </div>
		 <div class="col-md-3">
                       <!-- <a href="<?php echo site_url('qrcode/index/'.$user->id); ?>" class="btn btn-primary btn-md btn-block"><?php echo lang("cimps_qr_code"); ?></a>-->
                    </div>
                </div> 

            </div>
          <br>

            <script>
                $(document).ready(function() {

                   idGroup = $("#group").val();
                   regVenue = $("#regVenue").val();

                   if(idGroup != 4){
                      $("#contenedor_matricula").hide();
                      $("#contenedor_tallas").hide();
                  } else if(regVenue !=1) {
                      $("#contenedor_matricula").hide();
                  }

              });
          </script>
