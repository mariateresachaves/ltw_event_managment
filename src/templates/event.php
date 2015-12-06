<?php
    $db = new PDO('sqlite:../db/events.db');
    session_start();
    if(!isset($_SESSION['login_user'])) {
        header("Location: index.php");
        die();
    }
    $name = $_SESSION['name'];
    $username = $_SESSION['login_user'];
    $stmt = $db->prepare("SELECT name, image, events.id_event FROM events, participations WHERE events.id_event=participations.id_event 
                                                                               AND participations.username=?");
	$stmt->execute(array($username));
	$events = $stmt->fetchAll();
    $stmt2 = $db->prepare("SELECT events.*, events_types.name AS eventName FROM events, events_types WHERE events.id_event=? AND events.id_events_types=events_types.id_events_types");
	$stmt2->execute(array($_GET['event_id']));
	$event_selected = $stmt2->fetch();
    $stmt3 = $db->prepare("SELECT text, username FROM comments WHERE id_event=?");
    $stmt3->execute(array($_GET['event_id']));
	$event_comments = $stmt3->fetchAll();
    $stmt4 = $db->prepare("SELECT id_event FROM participations WHERE participations.username=? AND id_event=?");
	$stmt4->execute(array($_SESSION['login_user'], $_GET['event_id']));
	$user_participations = $stmt4->fetch();
    if(!empty($user_participations))
        $going = "Not Going";
    else
        $going = "Going";
	$stmt5 = $db->prepare("SELECT link FROM events_images WHERE id_event = ?");
	$stmt5->execute(array($_GET['event_id']));
	$image_links = $stmt5->fetchALL();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Event</title>
        <link rel="stylesheet" href="../css/style7.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<meta property="og:url" content="<?php echo "http://localhost/ltw_event_managment/src/templates/event.php?event_id=".$_GET["event_id"]?>" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Event Management" />
		<meta property="og:description"   content="<?php echo $event_selected['description'] ?>" />
		<meta property="og:image"         content="<?php echo $event_selected['image'] ?>" />
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
                <div id="logout">
                    <a href="log_out.php">LOGOUT</a>
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
                        <a href="event.php<?php echo "?event_id=" . $event['id_event']; ?>"><img src="<?php echo $event['image']; ?>" alt="User Icon"></a>
                        <a href="event.php<?php echo "?event_id=" . $event['id_event']; ?>"><p> <?php echo $event['name']; ?></p></a>
                    </div>

                <?php      
                    }
                ?>
            </div>
        </div>
        
        <div class="container">
            <div id="event_top">
                <div id="event_name">
                    <h2><?php echo $event_selected['name'];?></h2>
                </div>
                <div id="event_date">
                    <?php echo $event_selected['event_date'];?>
                </div>
            </div>
            <div id="event_image">
                <img src="<?php echo $event_selected['image'];?>">
            </div>
            <div id="event_description">
                <?php echo $event_selected['description'];?>
            </div>
            <div id="event_type">
                <p>Type: <?php echo $event_selected['eventName'];?></p>
            </div>
            <div id="event_going">
                    <form class="eventForm" method="post">

                        <input type="button" name="going" value="<?php echo $going ?>" class="going" id="<?php echo $event_selected['id_event'] ?>">
                    </form>
            </div>
            <div class="fb-share-button" data-href=<?php echo "http://localhost/ltw_event_managment/src/templates/event.php?event_id=".$_GET['event_id']?> data-layout="button"></div>
				<a href="<?php echo "mailto:?subject=I wanted you to check out this event&amp;body=Check out event "."http://localhost/ltw_event_managment/src/templates/event.php?event_id=".$_GET['event_id']."."; ?>" 
				title="Share this event by email!">
					<img src="http://png-2.findicons.com/files/icons/573/must_have/48/mail.png">
				</a>
			<div id="event_images">
				<?php foreach($image_links as $image_link)
				{
					echo '<a href="'.$image_link['link'].'">'.$image_link['link'].'</a><br>';
				}?>		
			</div>	
            <div id="event_comments">
                <hr>
                <h2>Comments</h2>
                <?php 
                    foreach ($event_comments as $comment) {
                ?>
                        <div id="comment">
                            <div id="commentOwner">
                                <?php echo $comment['username']?>
                            </div>

                            <div id="commentDescription">
                                <p><?php echo $comment['text'];?> </p>
                            </div>
                        </div>
                        <hr>
                <?php      
                    }
                ?>
            </div>
            <div id="add_comment">
                <form>
                    <input type="hidden" id="id_event" value="<?php echo $_GET['event_id'] ?>">
                    <textarea placeholder="Insert here your comment" rows=4 cols=77 id="comment_description"></textarea>
                    <input type="button" value="publish" id="publish">
                </form>
            </div>
        </div>
        
        <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v2.5";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
            
        var j = jQuery.noConflict();
        j(document).ready(function(){
            j(document).on("click", ".going", function(event){
                var id_event = "id_event=" + event.target.id;
                var status = "&going=" + event.target.value;
                var index2 = id_event + status;
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
                                    document.getElementById(event.target.id).value=data[0];
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
            });
        });
            
        $("#add_comment").on("click", "#publish", function() {
            var id_event = $("#id_event").val();
            var comment = "comment=" + document.getElementById("comment_description").value;
            var index = comment + "&id_event=" + id_event;
            
            var status = $.ajax({
                type: "POST",
                url: "../db/addComment.php",
                cache: false,
                async: false,
                data: index,
                dataType: "json",
                success: function(data) {
                            // data exists
                            if(data) {
                                document.getElementById("comment_description").value = "";
                                document.getElementById("event_comments").innerHTML = data;
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
        });
            
        $("textarea").keyup(function (e) {
            autoheight(this);
        });
        function autoheight(a) {
            if (!$(a).prop('scrollTop')) {
                do {
                    var b = $(a).prop('scrollHeight');
                    var h = $(a).height();
                    $(a).height(h-5);
                }
                while (b && (b != $(a).prop('scrollHeight')));
            };
            $(a).height($(a).prop('scrollHeight'));
        }
        autoheight($("textarea"));
        </script>
	</body>
</html>