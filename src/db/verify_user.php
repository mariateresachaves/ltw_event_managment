<?php

    include_once('connection.php');

    // Verifies if this user exists in the database and verifies his corresponding password

	$stmt_1 = $db->prepare("SELECT username FROM users WHERE username=? AND password=?");
	$stmt_1->execute(array($_POST["username"], md5($_POST["password"])));  
	$result = $stmt_1->fetchAll();
	
    // user and password OK
	if(!empty($result))
		echo json_encode("true");

    // user or password not correct
    else
        echo json_encode("false");

?>