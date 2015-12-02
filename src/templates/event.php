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
		<title>Event</title>
	</head> 
	<body>
		Event Page
	</body>
</html>