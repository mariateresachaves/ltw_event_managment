<?php
	include_once('connection.php');
	
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	
	$stmt = $db->prepare("SELECT name, username, password FROM users WHERE username='".$username."' AND password='".$password."'");
	$stmt->execute();  
	$result = $stmt->fetchAll();

    // Check if user is not registered
	if(empty($result))
	{
		header('Location: ../user_notr.html');
		die();
	}
    // if user is registered
	else
	{
		$name = $result[0][0];
		session_start();
		$_SESSION['login_user']= $username;
	}
?>

<html>
	<head>
		<title><?php echo $username?>'s profile</title>
	</head>
    
	<body>
		<div id="user_greet">
			<h3> Hello <?php echo $name?>!</h3>
		</div>
        
		<div id="events_information">
			<h2> CREATE AN EVENT </h2>
			<h2> MANAGE YOUR EVENTS </h2>		
		</div>		
	</body>
</html>