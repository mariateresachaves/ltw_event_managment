<?php
    $db = new PDO('sqlite:../db/events.db');

    session_start();

    if(!isset($_SESSION['login_user'])) {
        header("Location: index.php");
        die();
    }

    $name = $_SESSION['name'];
    $username = $_SESSION['login_user'];

    $stmt0 = $db->prepare("SELECT * FROM users WHERE username=?");
	$stmt0->execute(array($username));
	$user = $stmt0->fetch();
    
    $stmt1 = $db->prepare("SELECT birthdate FROM users WHERE username=?");
	$stmt1->execute(array($username));
	$birthdate = $stmt1->fetch();
    
    $stmt2 = $db->prepare("SELECT COUNT (*) AS cnt FROM participations WHERE username=?");
    $stmt2->execute(array($username));
    $cnt_participations = $stmt2->fetch();

    $stmt3 = $db->prepare("SELECT COUNT (*) AS cnt FROM events WHERE username=?");
    $stmt3->execute(array($username));
    $cnt_owner = $stmt3->fetch();

    $stmt3 = $db->prepare("SELECT registdate FROM users WHERE username=?");
    $stmt3->execute(array($username));
    $registdate = $stmt3->fetch();

    $stmt4 = $db->prepare("SELECT * FROM events WHERE username=?");
	$stmt4->execute(array($_SESSION['login_user']));
	$user_events = $stmt4->fetchAll();
    
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $username?>'s profile</title>
        <link rel="stylesheet" href="../css/style6.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head> 
	<body>
        <div id="menuBackground">
        </div>
        
		<div class="menu">
            <div id="left">
                <div id="logo">
                    <a href="dashboard.php"><img src="../imgs/icon.png"></a>
                </div>
                
                <header id="title">
                    <a href="dashboard.php"><h2>Event Management</h2></a>
                <header>
            </div>
        </div>
        
		<div class="container">
            <div id="topContainer">
                <header id="nameProfile">
                    <h1><?php echo $name?> Profile</h1>
                </header>    
            </div>
            
            <div id="leftContainer">
                <div id="profileInformation">
                    <img src="<?php echo $user['img'] ?>" alt="User Image">
                    <div id="profileInfoCont">
                        <p><?php echo $name?></p>
                        <p>going to <br> <?php echo $cnt_participations[0]?> events</p>
                        <p>owner of <br> <?php echo $cnt_owner[0]?> events</p>
                        <p>Birthdate <br> <?php echo $birthdate[0]?></p>
                        <?php
                            list($r_date, $r_hour) = explode(" ", $registdate[0]);
                        ?>
                        <p>member since <br> <?php echo $r_date?></p>
                        <form onsubmit="return editProfile()">
                            <input type="submit" value="Edit Profile" id="editProfile">
                        </form>
                    </div>
                </div>
            </div>
            
            <div id="rightContainer">
                <div id="rightContainerMenu">
                    <div id="myEvents" onclick="clickMyEvents()">
                        <h3>My events</h3>
                    </div>
                    <div id="activity" onclick="clickActivity()">
                        <h3>Activity</h3>
                    </div>
                    <div id="createEvent">
                        <a href="create_event.php"><h3>Create an event</h3></a>
                    </div>
                </div>
                
                <div id="eventsInformation">
                    <?php foreach($user_events as $event) {
                    ?>
                        <div id="information">
                            <div id="informationLeft">
                                <div id="informationImg">
                                    <a href="event.php?event_id=<?php echo $event['id_event'] ?>"><img src=" <?php echo $event['image'] ?>" alt="Event Image"></a>
                                </div>
                            </div>

                            <div id="informationRight">
                                <div id="informationName">
                                    <a href="event.php?event_id=<?php echo $event['id_event'] ?>"><h3><?php echo $event['name'] ?></h3></a>
                                </div>

                                <div id="informationDescription">
                                    <p> <?php echo $event['description'] ?></p>
                                </div>
                            </div>
                            
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div id="createEvent">
                    <a href="create_event.php"><h3>CREATE AN EVENT</h3></a>
                </div>
            </div>
        </div>
        
        <script>
            function editProfile() {
                var user_exists = $.ajax({
                    type: "POST",
                    url: "../db/editProfile.php",
                    cache: false,
                    async: false,
                    data: "",
                    dataType: "json",
                    success: function(data) {
                                // data exists
                                if(data) {
                                    document.getElementById("eventsInformation").innerHTML=data;
                                }
                            
                                // data does not exists
                                else
                                    alert("An error occured.");
                            },
                    error: function() {
                                alert("error");
                            }
                });
            }
            
            function clickMyEvents() {
                var user_exists = $.ajax({
                    type: "POST",
                    url: "../db/profileMyEvents.php",
                    cache: false,
                    async: false,
                    data: "",
                    dataType: "json",
                    success: function(data) {
                                // data exists
                                if(data) {
                                    document.getElementById("eventsInformation").innerHTML=data;
                                }
                            
                                // data does not exists
                                else
                                    alert("You have no events");
                            },
                    error: function() {
                                alert("error");
                            }
                });
            }
            
            function clickActivity() {
                var user_exists = $.ajax({
                    type: "POST",
                    url: "../db/profileActivity.php",
                    cache: false,
                    async: false,
                    data: "",
                    dataType: "json",
                    success: function(data) {
                                // data exists
                                if(data) {
                                    document.getElementById("eventsInformation").innerHTML=data;
                                }
                            
                                // data does not exists
                                else
                                    alert("You are not going to any event.");
                            },
                    error: function() {
                                alert("error");
                            }
                });
            }
        </script>
	</body>
</html>