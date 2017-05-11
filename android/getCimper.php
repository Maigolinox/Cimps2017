<?php

	// This file is intented to acquire some information from an assistant of the CIMPS

	// So the first thing is to get the user id (which is previously scanned by the Android application via QR Code) and then create a SQL query and retrieve the information

	$id = $_GET['id'];

	// Get the database connection token
	require_once('dbConnect.php');
	
	// Get the assistant information
	$sql = "SELECT * FROM users WHERE id=$id";
	$r = mysqli_query($con,$sql);
	$result = array();
	$row = mysqli_fetch_array($r);

	// Get the group where the assistant belongs
	$sql2 = "SELECT * FROM groups WHERE id = (SELECT group_id FROM users_groups WHERE user_id=$id)";
	$r2 = mysqli_query($con,$sql2);
	$result2 = array();
	$row2 = mysqli_fetch_array($r2);

	// Get the payment information from the assistant
	$sql3 = "SELECT * FROM `order` WHERE users_id=$id";
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

	echo json_encode(array('result'=>$result));

	mysqli_close($con);

