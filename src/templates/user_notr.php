<?php
    session_start();

    if(isset($_SESSION['login_user'])) {
        header("Location: index.php");
        die();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Not registered</title>
        <meta http-equiv="refresh" content="3; url=index.php"/>
        <link rel="stylesheet" href="../css/style.css">
    </head>   
    <body>
        <h3>USER MAY NOT BE REGISTERED IN THIS WEBSITE!</h3>
    </body>
</html>