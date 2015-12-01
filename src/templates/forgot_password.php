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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/style3.css">
  </head>
  <body>
    <div id="menuBackground">
    </div>
      
    <div class="menu">
        <div id="left">
            <div id="logo">
                <a href="index.php"><img src="../imgs/icon.png"></a>
            </div>
            <div id="title">
                <a href="index.php"><h2>Event Management</h2></a>
            </div>
        </div>
    </div>  
    <div class="container">
        <h1>Forgot Your Username or Password?</h1>
        <p>Forgot your info? No problem! Enter your account's email address and we'll send you instructions on how to update your password.</p>
        <form id="form" action="../db/email_conf.php" method="post">
            <input type="email" name="email" placeholder="E-mail">
			
            <input type="submit" name="submit" value="Submit" id="submit">
        </form>
    </div>
  </body>
</html>