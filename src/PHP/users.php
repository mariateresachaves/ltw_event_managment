<?php
	include_once('connection.php');
	$stmt_1 = $db->prepare("SELECT username FROM users WHERE username=?");
	$stmt_1->execute(array($_POST["username"]));  
	$result = $stmt_1->fetchAll();

	
	if(!empty($result)) {
		header('Location: ../user_already_taken.html');
		die();
	}
	else {
		$stmt_2 = $db->prepare('INSERT INTO users (username, name, password, email, birthdate, gender) VALUES (:username, :name, :password, :email, :birthdate, :gender)');
		$stmt_2->bindParam(':username', $_POST["username"]);
		$stmt_2->bindParam(':name', $_POST["name"]);
		$hpassword = md5($_POST["password"]);
		$stmt_2->bindParam(':password', $hpassword);
		$stmt_2->bindParam(':email', $_POST["email"]);
		$stmt_2->bindParam(':birthdate', $_POST["birthdate"]);
		$stmt_2->bindParam(':gender', $_POST["gender"]);
		$stmt_2->execute();
		header('Location:../user_reg.html');
		die();
	}
?>