<?php
    session_start();

    if(isset($_SESSION['login_user'])) {
        header("Location: dashboard.php");
        die();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Event Manager</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
        <div id="container">
            <div class="logo">
                <img src="../imgs/icon.png">
                <h1>Event Management</h1>
            </div>
            <form id="form" action="../db/mainpage.php" onsubmit="return check_user()" method="post">
                <input id="username" type="name" name="username" placeholder="Username">
				
                <input id="password" type="password" name="password" placeholder="Password">
				
                <input id="submit" type="submit" name="submit" value="Login">
            </form>
            <br><a id="submit2" href="regist_form.php">Sign Up</a><br><br>
            <a id="submit3" href="forgot_password.php">Forgot your username or password?</a>
        </div>
        <script>
            function check_user() {
                var username = document.getElementById("username").value;
                var password = document.getElementById("password").value;
                
                var index_username = "username=" + username;
                var index_password = "password=" + password;
                
                var index = index_username + "&" + index_password;
                
                var user_exists = $.ajax({
                    type: "POST",
                    url: "../db/verify_user.php",
                    cache: false,
                    async: false,
                    data: index,
                    dataType: "json",
                    success: function(data) {
                                // data exists
                                if(data) {
                                    // User or password does not exist in the database
                                    if(data == "false")
                                        alert("Username or password incorrect!");
                                }
                                // data does not exist
                                else
                                    alert("An error occurred.");
                            },
                    error: function() {
                                alert("Error!");
                            }
                });
            
                // Verifies the response from verify_user.php
            
                if(user_exists.responseJSON == "true")
                    return true;
            
                else
                    return false;
            }
        </script>
    </body>
</html>