<?php
	include_once('connection.php');
	$stmt_1 = $db->prepare("SELECT username FROM users WHERE username='".$_POST["username"]."'");
	$stmt_1->execute();  
	$result_1 = $stmt_1->fetchAll();
	
	if(!empty($result_1))
	{
		echo '<script type="text/javascript">';
		echo 'alert("Username has already been taken!")';
		echo '</script>';
	}
	else
	{
		$stmt_2 = $db->prepare('INSERT INTO users (username, name, password, email, dateu, gender) VALUES (:username, :name, :password, :email, :dateu, :gender)');
		$stmt_2->bindParam(':username', $_POST["username"]);
		$stmt_2->bindParam(':name', $_POST["name"]);
		$hpassword = md5($_POST["password"]);
		$stmt_2->bindParam(':password', $hpassword);
		$stmt_2->bindParam(':email', $_POST["email"]);
		$stmt_2->bindParam(':dateu', $_POST["date"]);
		$stmt_2->bindParam(':gender', $_POST["gender"]);
		$stmt_2->execute();
		header('Location:../user_reg.html');
		die();
	}
?>