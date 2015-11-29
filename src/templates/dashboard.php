<?php
    $db = new PDO('sqlite:../db/events.db');

    session_start();
    $name = $_SESSION['name'];
    $username = $_SESSION['login_user'];

    $stmt = $db->prepare("SELECT name, image FROM events, participations WHERE events.id_event=participations.id_event 
                                                                               AND participations.username=?");
	$stmt->execute(array($username));
	$events = $stmt->fetchAll();

    $stmt2 = $db->prepare("SELECT name FROM events_types");
	$stmt2->execute();
	$events_types = $stmt2->fetchAll();

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
            <div id="right">
                <a href="../db/create_event.php"><h3>CREATE AN EVENT</h3></a>
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
                    foreach ($events as $event) {
                ?>

                    <div id="event">
                        <img src="<?php echo "../" . $event['image']?>" alt="User Icon">
                        <p><?php echo $event['name']; ?></p>
                    </div>

                <?php      
                    }
                ?>
            </div>
        </div>
        
        <div class="container">
            <div id="eventsInformation">
                
                <?php
                    $count = 0;
                
                    foreach($events_types as $events_type) {
                
                        switch($count) {
                            case 0:
                ?>
                                <div id="comboEvent">
                                    <div id="eventBox1">
                                    <?php
                                        echo $events_type['name'];
                                    ?>
                                    </div>
                <?php
                                $count = $count + 1;
                                break;
                            case 1:
                ?>
                                    <div id="eventBox2">
                                    <?php
                                        echo $events_type['name'];
                                    ?>
                                    </div>
                                </div>
                <?php
                                $count = $count - 1;
                                break;
                            default:
                                break;
                        }
                    }
                
                    if($count == 0) {
                ?>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
	</body>
</html>