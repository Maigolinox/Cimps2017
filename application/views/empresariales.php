	<ul class="nav nav-justified">
        <li><a href="http://cimps.cimat.mx/registration_system/index.php/user/"><?php echo lang("cimps_MenuHome"); ?></a></li>
		<li class="active" ><a href="<?php echo site_url('user/information') ?>"><?php echo lang("cimps_MenuUpdate"); ?></a></li>
        <li><a href="<?php if (isset($admin) && $admin)
          						echo site_url('payment/index'.$url_crud_id);
          					 else 
          						echo site_url('descargas'); ?>"><?php echo lang("cimps_MenuAdd"); ?></a></li>
        <li><a href="<?php echo site_url('auth/change_password') ?>"><?php echo lang("cimps_MenuChange"); ?></a></li>
        <li><a href="http://cimps.ingsoft.info/contact-information" target="_blank"><?php echo lang("cimps_MenuContact"); ?></a></li>
		<li><a href="<?php echo site_url('auth/logout') ?>"><?php echo lang("cimps_MenuLogout"); ?></a></li>
    </ul>
	
	<div style="margin:20px;"></div>
	
	<div class="row">
		<div class="col-md-12">
			<h1>Presentaciones empresariales</h1>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/130604LQTqoltED01.pdf') ?>"><strong>Life Quality Technology (QoLT Meeting)</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/Espanol_Presentacion_CorporativaMexico.pdf') ?>"><strong>Everis(información corporativa)</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/InnovaTiA_102013.pdf') ?>"><strong>InnovaTiA</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/Kael_Blitz.pdf') ?>"><strong>Kael Soft</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/canteraSoftware.pdf') ?>"><strong>Cantera Software</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/PresentaciónEjecutiva01102013.pdf') ?>"><strong>Qualtop</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/PresentacionInnovatia.pdf') ?>"><strong>IACE</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/Presentacion_Zacatecas.pdf') ?>"><strong>FÁBRICA DE SOFTWARE I.T.S.Za.S.</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/PresentaMesa_CIMPS_UAZ.pdf') ?>"><strong>Universidad Autónoma de Zacatecas</strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/YUSA.SistemaDeMonitoreo.pdf') ?>"><strong>YUSA Autoparts México </strong></a></h4>
			<h4><a href="<?php echo site_url('/descargas/d/empresarial/Presentacion_CIMPS.ppsx') ?>"><strong>Aster</strong></a></h4>
			</td>
			
 
		</div>
	</div>
