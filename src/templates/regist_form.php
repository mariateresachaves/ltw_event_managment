<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="../css/style2.css">
    </head>

    <body>
        <div class="menu">
            <div id="left">
                <div id="logo">
                    <img src="../imgs/icon.png">
                </div>
                
                <div id="title">
                    <h2>Event Management</h2>
                </div>
            </div>
        </div>
        
        <div class="container">
            <h1>Create your account</h1>
            
            <form id="formDiv" action="../db/users.php" method="post">
                    <label>Username:<br></label>
                    <input type="name" name="username" placeholder="Choose an username" required>

                    <label>Name:<br></label>
                    <input type="name" name="name" placeholder="First and last name" required>
                    
                    <label><br>E-mail:<br></label>
                    <input type="email" name="email" placeholder="E-mail address" required>

                    <label><br>Password:<br></label>
                    <input type="password" name="password" placeholder="Choose a password" required>

                    <label><br>Birth Date:<br></label>
                    <input type="date" name="birthdate" max="<?php echo date('Y-m-d'); ?>" required>
                    <label><br>Gender:</label>
                    
                <div id="gender">
                    <input type="radio" name="gender" value="Male" checked required> Male
                    <input type="radio" name="gender" value="Female" required> Female
                <div/>
                    
                <input type="submit" name="submit" value="Sign Up" id="submit"/>
            </form>
        </div>
    </body>
</html>