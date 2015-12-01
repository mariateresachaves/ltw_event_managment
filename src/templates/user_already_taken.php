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
        <title>Login failed</title>
        <meta http-equiv="refresh" content="3; url=regist_form.php"/>
        <link rel="stylesheet" href="../css/style.css">
    </head>  
    <body>
        <h3>THIS USERNAME HAS ALREADY BEEN TAKEN!</h3>
    </body>
</html>