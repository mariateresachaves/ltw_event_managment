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
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        
	</head>
	<body>
        <div id="menuBackground">
        </div>
        
		<div class="menu">
            <div id="left">
                <div id="logo">
                    <a href="dashboard.php"><img src="../imgs/icon.png"></a>
                </div>
                
                <div id="title">
                    <a href="dashboard.php"><h2>Event Management</h2></a>
                </div>
            </div>
            
            <div id="right">
                <div id="search">
                    <form onsubmit="return searchEvent()" id="form1">
                        <input type="text" name="search" id="searchBar" placeholder="Search">
                        <input type="submit" value id="searchButton">
                    </form>
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
                        <a href="event.php"><img src="<?php echo "../" . $event['image']?>" alt="User Icon"></a>
                        <a href="event.php"><p><?php echo $event['name']; ?></p></a>
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
            function searchEvent() {
                var name = document.getElementById("searchBar").value;
                var index = "name=" + name;
                
                var event_exists = $.ajax({
                    type: "GET",
                    url: "../db/search.php",
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
                                    alert("An error occurred");
                            },
                    error: function() {
                                alert("error");
                            }
                });
                return false;
            }
            
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
            
            function changeGoing(str) {
                
                var splitedStr = str.split(",");
                var id = splitedStr[0];
                var g = splitedStr[1];
                
                var index = "id_event=" + id;
                var status = "&going=" + g;
                var index2 = index + status;
                
                var status = $.ajax({
                    type: "POST",
                    url: "../db/changeGoing.php",
                    cache: false,
                    async: false,
                    data: index2,
                    dataType: "json",
                    success: function(data) {
                                // data exists
                                if(data) {
                                    document.getElementById(id).value=data[0];
                                    document.getElementById("userEvents").innerHTML = data[1];
                                }
                                // data does not exists
                                else
                                    alert("An error occurred");
                            },
                    error: function() {
                                alert("error");
                            }
                });
                return false;
            }
        </script>
	</body>
</html>