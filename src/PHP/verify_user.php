<?php

    include_once('connection.php');

	$stmt_1 = $db->prepare("SELECT username FROM users WHERE username=? AND password=?");
	$stmt_1->execute(array($_POST["username"], md5($_POST["password"])));  
	$result = $stmt_1->fetchAll();
	
	if(!empty($result))
		echo json_encode("true");

    else
        echo json_encode("false");

?>