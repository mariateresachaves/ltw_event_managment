<?php
    include "class.phpmailer.php";
    include_once('connection.php');

    $email = $_POST["email"];

    // Verifies if this email exists in the database

	$stmt_1 = $db->prepare("SELECT username FROM users WHERE email=?");
	$stmt_1->execute(array($email));  
	$result = $stmt_1->fetchAll();

    // User are not registered yet
	if(empty($result)) {
		header('Location: ../templates/user_notr.html');
		die();
	}

    // Sends the email to recover the password
    else {
        $token = uniqid();
        
        // Email content
        $body = "
                    Hello! <br><br>
                    A user requested a password recovery retrieval for this e-mail address at " . $email . "<br>
                    If you have no idea what this message is about, please ignore it. <br>
                    To recover your password click on this <a href=\"http://localhost/ltw_event_managment/src/templates/recover_password.php?token=" . $token . "\">link</a>. <br><br>

                    Thanks, <br>
                    Event Management
                ";

        $email_packet = new PHPMailer();                              // Create a object of class PHPMailer
        $email_packet->IsSMTP();                                      // To send via Simple Mail Transfer Protocol
        $email_packet->SMTPDebug = 1;                                 // On debugging if 1 -> errors and messages; 2 -> messages
        $email_packet->SMTPAuth = true;                               // If exists authentication (in this case exists)
        $email_packet->SMTPSecure = 'ssl';                            // Gmail forces to use the protocol ssl
        $email_packet->Host = "smtp.gmail.com";
        $email_packet->Port = 465;
        $email_packet->IsHTML(true);                                  // If exists html tags on email body
        $email_packet->Username = "ltw.event.management@gmail.com";   // Sender email
        $email_packet->Password = "nunoteresasilvachaves";            // Sender email Password
        $email_packet->SetFrom("ltw.event.management@gmail.com");     // Address of sender
        $email_packet->Subject = "Password recovery";                 // Subject of the email
        $email_packet->Body = $body;                                  // Email body
        $email_packet->AddAddress($email);                            // Receiver email

        $email_packet->Send();
        
        // Update the sent token
        $stmt_1 = $db->prepare("UPDATE users SET token = ? WHERE email = ?");
	    $stmt_1->execute(array($token, $email));
        
        header("Location: ../templates/check_your_email.php");
        die();
    }
?>