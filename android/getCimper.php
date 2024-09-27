<?php

	// This file is intented to acquire some information from an attendant of the CIMPS

	// So the first thing is to get the user id
	// (which is previously scanned by the Android application via QR Code)
	// and then create a SQL query and retrieve the information

	$id = $_GET['id'];

	// Get the database connection token
	require_once('dbConnect.php');
	
	// Get the attendant information
	$sql = "SELECT `name`, `afiliation_name`, `gaffete` FROM users WHERE id=$id";
	$r = mysqli_query($con,$sql);
	$result = array();
	$row = mysqli_fetch_array($r);

	// Get the group where the attendant belongs
	$sql2 = "SELECT `name` FROM groups WHERE id = (SELECT group_id FROM users_groups WHERE user_id=$id)";
	$r2 = mysqli_query($con,$sql2);
	$result2 = array();
	$row2 = mysqli_fetch_array($r2);

	// Get the payment information from the assistant
	$sql3 = "SELECT `accepted` FROM `order` WHERE users_id=$id";
	$r3 = mysqli_query($con,$sql3);
	$result3 = array();
	$row3 = mysqli_fetch_array($r3);

	// Convert accents into plain text
	setlocale(LC_ALL, 'es_MX');
	$clear_name = iconv('UTF-8','ASCII//TRANSLIT//IGNORE',utf8_encode($row['name']));
	$clear_afiliation_name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE',utf8_encode($row['afiliation_name']));

	array_push($result,array(
			"name"=>$clear_name,
			"afiliation"=>$clear_afiliation_name,
			"category"=>$row2['name'],
			"gaffete"=>$row['gaffete'],
			"accept"=>$row3['accepted']
		));


	// Get the events information from the attendant
	$sql4 = "SELECT asistentes_por_fecha.id_evento, eventos.nombre_externo "
			. "FROM asistentes_por_fecha INNER JOIN eventos ON"
			. " eventos.id = asistentes_por_fecha.id_evento"
			. " WHERE asistentes_por_fecha.id_user = $id ORDER BY eventos.fecha ASC";
	$r4 = mysqli_query($con, $sql4);
	while ($my_row = mysqli_fetch_array($r4, MYSQLI_ASSOC)) {
		$id_evento = $my_row['id_evento'];
		$row_array['id_evento'] = $my_row['id_evento'];
		$clear_nombre_externo = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', utf8_encode($my_row['nombre_externo']));
		$clear_nombre_externo = strip_tags($clear_nombre_externo);
		$clear_nombre_externo = trim($clear_nombre_externo);
		$row_array['nombre_externo'] = $clear_nombre_externo;
		// search event
		$sql5 = "SELECT `id_evento` FROM asistencia_eventos WHERE `id_user`=$id and `id_evento` = $id_evento";
		$r5 = mysqli_query($con,$sql5);
		$row5 = mysqli_fetch_array($r5);
		if(!is_null($row5['id_evento'])){
			$row_array['asistencia'] = 1; 
		}else{
			$row_array['asistencia'] = 0; 
		}
		array_push($result, $row_array);
	}
	

	echo json_encode(array('result' => $result));
	mysqli_close($con);

