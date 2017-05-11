
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url() ?>ico/favicon.png">
    <link rel="shortcut icon" href="<?php echo base_url() ?>ico/favicon.png">

    <title>CIMPS 2017</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url() ?>assets/css/justified-nav.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/estilos.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/csslogin2017.css" rel="stylesheet">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.numeric.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/numeral.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url() ?>assets/js/html5shiv.js"></script>
      <script src="<?php echo base_url() ?>assets/js/respond.min.js"></script>
    <![endif]-->


  </head>

  <body>
   <div class="headline-inner">
    <div class="container">

      <div class="masthead">
        <div class="row">
			  <!--Secambio por el diseño 2017
			  <div class="col-xs-12 col-sm-6 col-md-8">
			     <div class="masthead"> linea comentada
				<a href="http://cimps.ingsoft.info/"><img src="<?php //echo base_url() ?>assets/img/logo-cimps.png"/></a>
			     </div>linea comentada
			  </div>-->
			  <div class="col-xs-6 col-sm-6 col-md-4">
			  
			  <?php if(get_userdata('language') != "spanish") { ?><br/><br/>
			  <a style="color:white;font-family:Verdana,Tahoma,Arial;" href="<?php echo site_url('user/es'); ?>">Ver sitio en Espa&ntilde;ol&nbsp;<img src="http://cimps.cimat.mx/wp-content/uploads/2016/06/Mexico512x512.png" alt="Espa&ntilde;ol" style="width:50px;height:43px;border:0;"/></a>
			  <?php } else { ?><br/><br/>
			  <a style="color:white;font-family:Verdana,Tahoma,Arial;" href="<?php echo site_url('user/en'); ?>">See site in English&nbsp;<img src="http://cimps.cimat.mx/wp-content/uploads/2016/05/uk-icon.png" alt="English" style="width:42px;height:42px;border:0"/></a>
			  <?php } ?>
			  
			  <?php if(isset($user) && !empty($user)){ ?>
				<div style="color:white;font-family:Verdana,Tahoma,Arial;"><u><?php echo $user->username ?></u> (<a href="<?php echo site_url('auth/logout') ?>"><strong>Logout</strong></a>)&nbsp;&nbsp;<a href="http://cimps.cimat.mx/registration_system/index.php/user/" style="color:white;"><strong><font size="-2">Home</font></strong></a>
					<?php if (isset($admin)){ ?><p><font size="-2">[<a href="<?php echo site_url('admin') ?>"><strong>User Mngmt.</strong></a>][<a href="<?php echo site_url('program/admin') ?>"><strong>Program Mngmt.</strong></a>][<a href="<?php echo site_url('programWork/admin') ?>"><strong>Program Workshop Mngmt.</strong></a>]</font></p>
                                        <?php } else { ?> <br/> <?php if($accepted) { ?>
					[<a href="http://sistemas.ita.mx/fieat/registro/?id=<?php echo $user->id ?>&title=<?php echo $user->tittle ?>&name=<?php echo $user->name ?>&university=<?php echo $user->afiliation_name ?>&email=<?php echo $user->email ?>"><strong><font size="-2">Inscribirse a curso</font></strong></a>]
				<?php } ?><br/><?php } ?>
				</div><br/>
			  <?php }else{ ?>
			    <div style="color:white;font-family:Verdana,Tahoma,Arial;">Guest (<a href="<?php echo site_url('auth') ?>"><strong>Login</strong></a>)&nbsp;&nbsp;<a href="http://cimps.cimat.mx/registration_system/index.php/user/register" style="color:white;"><strong><font size="-2">Register</font></strong></a></div><br/><br/>
			  <?php } ?>
			  </div>
			  </div>
			  <br/><br/><br/><br/>
		</div>
	  
