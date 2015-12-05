<?php
	include_once('connection.php');
		
	$username = $_POST["username"];
	$name = $_POST["name"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$birthdate = $_POST["birthdate"];
	$gender = $_POST["gender"];
	
	$passwordh = password_hash($password, PASSWORD_DEFAULT);
	
	// Verifies if this username already exists in the database
	$username_check = $db->prepare("SELECT username FROM users WHERE username=?");
	$username_check->execute(array($_POST["username"]));  
	$result = $username_check->fetchAll();
	
	// username already exists
	if(!empty($result)) {
		header('Location: ../templates/user_already_taken.php');
		die();
	}
    // username can be used
	else {
		$user = $db->prepare('INSERT INTO users (username, name, password, email, birthdate, gender) VALUES (:username, :name, :password, :email, :birthdate, :gender)');
		$user->bindParam(':username', $username);
		$user->bindParam(':name', $name);
		$user->bindParam(':password', $passwordh);
		$user->bindParam(':email', $email);
		$user->bindParam(':birthdate', $birthdate);
		$user->bindParam(':gender', $birthdate);
		$user->execute();
		
		$stmt = $db->prepare('SELECT * FROM users');
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		var_dump($result);
        
		header('Location: ../templates/user_reg.php');
		die();
	}