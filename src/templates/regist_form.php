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
        <title>Register your account</title>
        <link rel="stylesheet" href="../css/style2.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    </head>
    <body>
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
            <h1>Create your account</h1>
            <form id="formDiv" action="../db/users.php" method="post">
                <label for="username">Username:<br></label>
                <input id="username" type="text" name="username" placeholder="Pick your username" required>
				
                <label for="name">Name:<br></label>
                <input id="name" type="name" name="name" placeholder="First and last name" required>
				
				<label for="email"><br>E-mail:<br></label>
                <input id="email" type="email" name="email" placeholder="E-mail address" required>
				
                <label for="password"><br>Password:<br></label>
                <input id="password" type="password" name="password" placeholder="Create a password" required>
				
                <label for="birthdate"><br>Birth Date:<br></label>
                <input id="birthdate" type="date" name="birthdate" max="<?php echo date('Y-m-d'); ?>" required>
				
                <label for="gender"><br>Gender:</label>
				<div id="gender">
					<input type="radio" name="gender" value="Male" checked required> Male
					<input type="radio" name="gender" value="Female" required> Female
				<div/>
				
                <input id="submit" type="submit" name="submit" value="Sign Up"/>
            </form>
        </div>
            
        <script>
            $(document).ready(function()) {
                
            }
        </script>    
    </body>
</html>