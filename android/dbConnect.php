<?php

	// Define the database credentials
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', 'CiMP5');
	define('DB', 'ingsofti_CIMPS3');

	// Connect to the database
	$con = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to connect to the database');