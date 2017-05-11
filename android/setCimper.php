<?php
	
	// This file is intented to update the field 'gaffete' of an assistant, which indicates that the CIMPS kit has been given to the assistant at the moment of the registration.

	// First, the data is retrieved, a SQL query is created and performed

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$afiliation = $_POST['afiliation'];
		$gaffete = $_POST['gaffete'];
		$accept = $_POST['accept'];

		// Use the database connection
		require_once('dbConnect.php');

		$sql = "UPDATE users SET name = '$name', afiliation_name = '$afiliation',  gaffete = '$gaffete', accept = '$accept' WHERE id = $id;";

		if(mysqli_query($con,$sql)){
			echo 'Asistente actualizado correctamente.';
		}else{
			echo 'No pudimos actualizar al asistente. Intente de nuevo.';
		}

		mysqli_close($con);
	}
