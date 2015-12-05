<?php
    session_start();

    if(isset($_SESSION['login_user'])) {
        header("Location: index.php");
        die();
    }
?>
<html>
    <head>
        <title>Success registering</title>
        <meta http-equiv="refresh" content="3; url=index.php"/>
        <link rel="stylesheet" href="../css/style.css">
    </head>    
    <body>
        <h3>USER REGISTERED SUCCESSFULLY!</h3>
    </body>
</html>