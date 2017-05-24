
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
    <link href="<?php echo base_url() ?>/assets/css/estilos.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


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
    			<div class="col-xs-12 col-sm-6 col-md-8">
    			<?php if(isset($user) && !empty($user)){ ?>
    			<!--logo-->  			
    				<img src="<?php echo base_url() ?>assets/img/logo2017.png"/>    			
				<!--/logo-->
				<?php } ?>
				</div>




		<div class="col-xs-6 col-sm-6 col-md-4" float: right; style="margin-top: 100px" >

			<!--seccion de lenguajes-->
			<?php if(get_userdata('language') != "spanish") { ?><br/><br/>
			<a style="color:white;font-family:Verdana,Tahoma,Arial;" href="<?php echo site_url('user/es'); ?>">Ver sitio en Espa&ntilde;ol&nbsp;<img src="<?php echo base_url() ?>assets/img/idioma_mex.png" alt="Espa&ntilde;ol" style="width:20px;height:12px;border:0;"/></a>
			<?php } else { ?><br/><br/>
			<a style="color:white;font-family:Verdana,Tahoma,Arial;" href="<?php echo site_url('user/en'); ?>">See site in English&nbsp;<img src="<?php echo base_url() ?>assets/img/idioma_usa.png" alt="English" style="width:20px;height:12px;border:0"/></a>
			<?php } ?>
			<!--/seccion de lenguajes-->



			<?php if(isset($user) && !empty($user)){ ?>
			
				<div class="btn-group"> 

            	

                <button class="btn btn-link dropdown-toggle"  data-toggle="dropdown" style="color: white"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></button>

            		<ul class="dropdown-menu">
               			<li><a><?php echo set_value('name', $user->name) ?></a></li>
              			<li><a><?php echo set_value('email', $user->email) ?></a></li>
                    
              			<!--Opciones Adminstrativas-->
              			<?php if (isset($admin)){ ?>
              				<li class="divider"></li>
              				<li><a href="<?php echo site_url('admin') ?>">User Mngmt.</a></li>
              				<li><a href="<?php echo site_url('program/admin')?>">Program Mngmt.</a></li>
              				<li><a href="<?php echo site_url('programWork/admin')?>">Program Workshop Mngmt.</a></li>	                      
						          <?php } ?> 
               			<!--/Opciones Adminstrativas-->

               			<li class="divider"></li>
               			<li><a href="<?php echo site_url('auth/change_password')?>"><?php echo lang("cimps_MenuChange");?></a></li>
               			<li class="divider"></li>
               			<li><a href="<?php echo site_url('auth/logout') ?>"><?php echo lang("cimps_logout"); ?></a></li>
            		</ul>
         		</div>
			<?php }// activa registro y login  else{ ?>
      

	<!--registro y login
		<div style="color:white;font-family:Verdana,Tahoma,Arial;">Guest (<a href="<?php echo site_url('auth') ?>"><strong>Login</strong></a>)&nbsp;&nbsp;

		<a href="http://127.0.0.1:4001/wordpress/registration_system/index.php/user/register" style="color:white;"><strong><font size="-2">Register</font></strong></a></div><br/><br/>
		<?php// } ?>
	/registro y login -->




			  </div>
			  </div>
			  <br/><br/><br/><br/>
		</div>
	  <!-- Jumbotron -->  
<div class="jumbotron" style="background-image: url('<?php echo base_url() ?>assets/img/logofondo.png'); width:100%; height: 100%;background-size:100% 100%;">
