<?php
    $db = new PDO('sqlite:../db/events.db');

    session_start();

    if(!isset($_SESSION['login_user'])) {
        header("Location: index.php");
        die();
    }

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
                <a href="profile.php"><img src="../imgs/user_avatar.png" alt="User Icon"></a>
                <a href="profile.php"><p><?php echo $name ?></p></a>
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
                                <div class="comboEvent">
                                    <div id="<?php echo $events_type['name'] ?>" class="eventBox1" onclick="clickEvent('<?php echo $events_type['name']?>')">
                                    <?php
                                        echo $events_type['name'];
                                    ?>
                                    </div>
                <?php
                                $count = $count + 1;
                                break;
                            case 1:
                ?>
                                    <div id="<?php echo $events_type['name'] ?>" class="eventBox2" onclick="clickEvent('<?php echo $events_type['name']?>')">
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
    
        <script>
            function clickEvent(name) {
                
                var index = "name=" + name;
                
                var user_exists = $.ajax({
                    type: "POST",
                    url: "../db/typeEvents.php",
                    cache: false,
                    async: false,
                    data: index,
                    dataType: "json",
                    success: function(data) {
                                // data exists
                                if(data) {
                                    // User or password does not exist in the database
                                    document.getElementById("eventsInformation").innerHTML=data;
                                }
                            
                                // data does not exists
                                else
                                    alert("There are no events of that type.");
                            },
                    error: function() {
                                alert("error");
                            }
                });
            }
        </script>
	</body>
</html>