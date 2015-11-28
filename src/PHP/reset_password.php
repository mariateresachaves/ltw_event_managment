<?php

    include_once('connection.php');

    $token = $_POST["token"];
    
    // Verify if the user clicked on submit button
    if(isset($_POST["submit"])) {
        
        $password = md5($_POST["password"]);
        
        // Update the password
        $stmt_1 = $db->prepare("UPDATE users SET password = ? WHERE token = ?");
	    $stmt_1->execute(array($password, $token));
        
        header("Location: ../index.html");
        die();
    }
    
    else {
        header("Location: ../index.html");
        die();
    }

?>