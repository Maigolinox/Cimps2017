<?php if(isset($descargar)){ ?>
<div style="text-align:right"><a class="btn btn-primary btn-large" href="http://cimps.cimat.mx/registration_system/index.php/program/download">Descargar</a></div>
<?php } ?>
<table id="program">
	<h2 align="center"> Programa General </h2>
<?php $fecha = ""; 
while($evento = current($eventos)){ ?>
 <?php if($fecha != $evento->dia){
			echo "<tr><td colspan=\"2\"><h3>".fecha_larga($evento->dia)."</h3></td></tr>";
			$fecha = $evento->dia;
		}
 ?>
 <tr>
	<td class="hora" style="text-align:right; padding-right:10px; width:100px "><?php echo limpiar($evento->hora_inicio) ?> - <?php echo limpiar($evento->hora_fin) ?></td>
		<?php $e = next($eventos) ?>
		<?php if($e and $e->hora_inicio == $evento->hora_inicio){ ?>
			<td class="borde">
			<table class="tabla-interior">
				<tr><td colspan="3" style="font-size:14px; font-weight:bold"><?php echo $evento->nombre ?></td></tr>
				<tr>
					<td>
					<div style="background-color:#D3D3D3; text-align:center"><?php echo $evento->lugar ?></div>
					<?php echo $evento->descripcion ?>
					</td>
				
			<?php while($e->hora_inicio == $evento->hora_inicio){ ?>
					<td>
						<div style="background-color:#D3D3D3; text-align:center"><?php echo $e->lugar ?></div>
						<?php echo $e->descripcion ?>
					</td>
					
					<?php $e = next($eventos); ?>
			<?php } prev($eventos) ?>
				</tr>
			</table>
			</td>
		<?php }else{  prev($eventos); ?>
				<td class="borde">
					<?php if(!empty($evento->lugar)){ ?>
						<div style="background-color:#D3D3D3; text-align:center"><?php echo $evento->lugar ?></div>
					<?php } ?>
					<div style="font-size:14px; font-weight:bold"><?php echo $evento->nombre ?> <?php if(!empty($evento->descripcion)) echo ":" ?></div>
					<?php echo $evento->descripcion ?>
				</td>
		<?php } ?>
	
 <tr>
 <?php next($eventos); } 
 
	function limpiar($hora){
		$separada = explode(':', $hora);
		return $separada[0].":".$separada[1];
	}
	
	function fecha_larga($fecha_corta){
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $dias[date('w', strtotime($fecha_corta))]." ".date('d', strtotime($fecha_corta))." de ".$meses[date('n', strtotime($fecha_corta))-1]. " del ".date('Y', strtotime($fecha_corta));
	}
 
 ?>
</table>