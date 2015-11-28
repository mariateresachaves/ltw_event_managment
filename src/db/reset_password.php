<?php

    include_once('connection.php');

    $token = $_POST["token"];
    
    // User clicked on submit button
    if(isset($_POST["submit"])) {
        $password = md5($_POST["password"]);
        
        // Update the password
        $stmt_1 = $db->prepare("UPDATE users SET password=? WHERE token=?");
	    $stmt_1->execute(array($password, $token));
        
        header("Location: ../templates/index.html");
        die();
    }
    
    // User doesn't clicked on submit button
    else {
        header("Location: ../templates/index.html");
        die();
    }

?>