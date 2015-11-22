<?php
	$db = new PDO('sqlite:events.db');
	$stmt = $db->prepare('INSERT INTO users (username, name, password, email, dateu, sex) VALUES (:username, :name, :password, :email, :dateu, :sex)');
	$stmt->bindParam(':username', $_POST["username"]);
	$stmt->bindParam(':name', $_POST["name"]);
	$hpassword = md5($_POST["password"]);
	$stmt->bindParam(':password', $hpassword);
	$stmt->bindParam(':email', $_POST["email"]);
	$stmt->bindParam(':dateu', $_POST["date"]);
	$stmt->bindParam(':sex', $_POST["sex"]);
	$stmt->execute();
	
	$stmt = $db->prepare('SELECT * FROM users');
	$stmt->execute();  
	$result = $stmt->fetchAll();
	
	foreach($result as $row) {
    echo '<h1>' . $row['username'] . '</h1>';
    echo '<p>' . $row['name'] . '</p>';
	echo '<p>' . $row['password'] . '</p>';
	echo '<p>' . $row['email'] . '</p>';
	echo '<p>' . $row['dateu'] . '</p>';
	echo '<p>' . $row['sex'] . '</p>';
  }
?>