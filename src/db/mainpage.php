<?php
	include_once('connection.php');
	
	$username = $_POST["username"];

	$signin = $db->prepare("SELECT name, username FROM users WHERE username = ?");
	$signin->execute(array($username));
	$result = $signin->fetchAll();
	
    // User is registered
	session_start();
        
    $name = $result[0][0];
	$_SESSION['login_user'] = $username;
    $_SESSION['name'] = $name;
        
    header('Location: ../templates/dashboard.php');
	die();