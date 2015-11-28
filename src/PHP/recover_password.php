<!DOCTYPE html>
<html>
  <head>
    <title>Password Recovery</title>
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
        
        <h1>Choose a new password</h1>
        
        <form id="form2" action="reset_password.php" onsubmit="return validate_password()" method="post">
            <input type="hidden" name="token" value="<?php echo $_GET["token"] ?>">
            <input id="password" type="password" name="password" placeholder="Password">
            <input id="confirm_password" type="password" name="confirm_password" placeholder="Confirm your password">
            <input type="submit" name="submit" value="Submit" id="submit">
        </form>
    </div>
      
    <script>
        
        function validate_password() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
        
            if(password === confirm_password)
                return true;

            else {
                alert("Passwords don't match.");
                return false;
            }
        }
        
    </script>
  </body>
</html>