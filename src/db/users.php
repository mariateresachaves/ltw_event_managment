<?php
	include_once('connection.php');
    // Verifies if this username already exists in the database
	$stmt_1 = $db->prepare("SELECT username FROM users WHERE username=?");
	$stmt_1->execute(array($_POST["username"]));  
	$result = $stmt_1->fetchAll();

	// username already exists
	if(!empty($result)) {
		header('Location: ../templates/user_already_taken.php');
		die();
	}
    // username can be used
	else {
		$stmt_2 = $db->prepare('INSERT INTO users (username, name, password, email, birthdate, gender) VALUES (:username, :name, :password, :email, :birthdate, :gender)');
		$stmt_2->bindParam(':username', $_POST["username"]);
		$stmt_2->bindParam(':name', $_POST["name"]);
        // $password = md5($_POST["password"]);
        $hpassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$stmt_2->bindParam(':password', $hpassword);
		$stmt_2->bindParam(':email', $_POST["email"]);
		$stmt_2->bindParam(':birthdate', $_POST["birthdate"]);
		$stmt_2->bindParam(':gender', $_POST["gender"]);
		$stmt_2->execute();
        
		header('Location:../templates/user_reg.php');
		die();
	}
?>