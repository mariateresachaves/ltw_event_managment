<?php
    $db = new PDO('sqlite:../db/events.db');

    session_start();

    if(!isset($_SESSION['login_user'])) {
        header("Location: index.php");
        die();
    }

    $name = $_SESSION['name'];
    $username = $_SESSION['login_user'];
    
    $stmt = $db->prepare("SELECT birthdate FROM users WHERE username=?");
	$stmt->execute(array($username));
	$birthdate = $stmt->fetch();
    
    $stmt2 = $db->prepare("SELECT COUNT (*) AS cnt FROM participations WHERE username=?");
    $stmt2->execute(array($username));
    $cnt_participations = $stmt2->fetch();

    $stmt3 = $db->prepare("SELECT COUNT (*) AS cnt FROM events WHERE username=?");
    $stmt3->execute(array($username));
    $cnt_owner = $stmt3->fetch();

    $stmt3 = $db->prepare("SELECT registdate FROM users WHERE username=?");
    $stmt3->execute(array($username));
    $registdate = $stmt3->fetch();
    
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $username?>'s profile</title>
        <link rel="stylesheet" href="../css/style6.css">
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
        </div>
        
		<div class="container">
            <div id="topContainer">
                <div id="nameProfile">
                    <h1><?php echo $name?> Profile</h1>
                </div>    
            </div>
            
            <div id="leftContainer">
                <div id="profileInformationBackground">
                </div>
                <div id="profileInformation">
                    <img src="../imgs/Pinguim-DSC08880.JPG" alt="User Image">
                    <div id="profileInfoCont">
                        <p><?php echo $name?></p>
                        <p>going to <br> <?php echo $cnt_participations[0]?> events</p>
                        <p>owner of <br> <?php echo $cnt_owner[0]?> events</p>
                        <p>Birthdate <br> <?php echo $birthdate[0]?></p>
                        <?php
                            list($r_date, $r_hour) = explode(" ", $registdate[0]);
                        ?>
                        <p>member since <br> <?php echo $r_date?></p>
                        <form>
                            <input type="submit" value="Edit Profile" id="editProfile">
                        </form>
                    </div>
                </div>
            </div>
            
            <div id="rightContainerBackground">
            </div>
            <div id="rightContainer">
                <div id="rightContainerMenuBackground">
                </div>
                <div id="rightContainerMenu">
                    <h3>Comments</h3>
                    <h3>My events</h3>
                    <h3>Activity</h3>
                </div>
                
                <div id="eventsInformation">
                    <h2> MANAGE YOUR EVENTS </h2>
                </div>

                <div id="createEvent">
                    <a href="../db/create_event.php"><h3>CREATE AN EVENT</h3></a>
                </div>
            </div>
        </div>
	</body>
</html>