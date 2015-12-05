<?php 
	session_start();
	session_unset(); 
	session_destroy();
?>
<html>
    <head>
        <title>Logged out successfully!</title>
        <meta http-equiv="refresh" content="3; url=index.php"/>
        <link rel="stylesheet" href="../css/style.css">
    </head>    
    <body>
        <h3>Logged out successfully!</h3>
		<h4>Redirecting you to the main page...</h4>
    </body>
</html>