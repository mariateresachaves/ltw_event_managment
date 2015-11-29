<?php
    $db = new PDO('sqlite:../db/events.db');

    session_start();
    $name = $_SESSION['name'];
    $username = $_SESSION['login_user'];

    $stmt = $db->prepare("SELECT name FROM events, participations WHERE events.id_event=participations.id_event 
                                                                        AND participations.username=?");
	$stmt->execute(array($username));
	$result = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Event management</title>
        <link rel="stylesheet" href="../css/style4.css">
	</head>
    
	<body>
        <div id="menuBackground">
        </div>
        
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
        
        
        <div id="userProfileBackground">
        </div>
        <div id="userProfile">
            <div id="profilePage">
                <img src="../imgs/user_avatar.png" alt="User Icon">
                <p><?php echo $name ?></p>
            </div>
            
            <hr>
            
            
            <div id="userEvents">
                <?php 
                    foreach($result as $event) {
                ?>

                <div id="event">
                    <img src="../imgs/user_avatar.png" alt="User Icon">
                    <p><?php echo $event['name']; ?></p>
                </div>

                <?php      
                    }
                ?>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                <p>HELLO</p>
                
            </div>
        </div>
        
        <div class="container">
            <div id="user_greet">
                <h3> Hello <?php echo $name ?>!</h3>
            </div>

            <div id="events_information">
				<a href="../db/create_event.php"><h3>CREATE AN EVENT</h3></a>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
                <p>HELLOHELLOHELLOHELLOHELLOHELLOHELLO</p>
            </div>
        </div>
        		
	</body>
</html>