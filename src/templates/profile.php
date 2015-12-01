<?php
    session_start();

    if(!isset($_SESSION['login_user'])) {
        header("Location: index.php");
        die();
    }
?>

<!DOCTYPE html>
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