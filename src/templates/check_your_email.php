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
    <link rel="stylesheet" href="../css/style4.css">
  </head>
  <body>
    <div id="menuBackground">
    </div>
    <div class="menu">
        <div id="left">
            <div id="logo">
                <a href="dashboard.php"><img src="../imgs/icon.png"></a>
            </div>
            
            <div id="title">
                <a href="dashboard.php"><h2>Event Management</h2></a>
            </div>
        </div>
    </div> 
    
    <div id="thanks">
        <h1>Thank you</h1>
        <p>We have sent you an e-mail with the instructions to reset your password.</p>
    </div>
  </body>
</html>