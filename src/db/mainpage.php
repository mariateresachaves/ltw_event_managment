<?php
	include_once('connection.php');
	
	$username = $_POST["username"];
	$password = md5($_POST["password"]);

    // Verifies if this user exists in the database

	$stmt = $db->prepare("SELECT name, username, password FROM users WHERE username=? AND password=?");
	$stmt->execute(array($username, $password));
	$result = $stmt->fetchAll();

    // User is not registered
	if(empty($result)) {
		header('Location: ../templates/user_notr.php');
		die();
	}

    // User is registered
	else {
		session_start();
        
        $name = $result[0][0];
		$_SESSION['login_user'] = $username;
        $_SESSION['name'] = $name;
        
        header('Location: ../templates/dashboard.php');
		die();
	}
?>