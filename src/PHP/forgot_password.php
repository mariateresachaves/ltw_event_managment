<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/style3.css">
  </head>
    
  <body>
    <div class="menu">
        <div id ="left">
            <div id="logo">
                <img src="../imgs/icon.png">
            </div>
            <div id="title">
                <h2>Event Management</h2>
            </div>
        </div>
    </div>
      
    <div class="container">
        <h1>Forgot Your Username or Password?</h1>
        <p>Forgot your info? No problem! Enter your account's email address and we'll send you instructions on how to update your password.</p>
        
        <form id="form" action="email_conf.php" method="post">
            <input type="email" name="email" placeholder="E-mail">
            <input type="submit" name="submit" value="Submit" id="submit">
        </form>
    </div>
  </body>
</html>