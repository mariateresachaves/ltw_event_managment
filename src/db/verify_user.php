<?php
    include_once('connection.php');
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
    // Verifies if this user exists in the database
	$check = $db->prepare("SELECT password FROM users WHERE username = ?");
	$check->execute(array($username));
	$result = $check->fetchAll();
	
	if(!empty($result))
	{
		if(password_verify($password, $result[0][0]))
			// User and password are OK
			echo json_encode("true");
		else // Password not correct
			echo json_encode("false");
	}
    // User not correct
    else
		echo json_encode("false");