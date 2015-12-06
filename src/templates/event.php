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

    $stmt3 = $db->prepare("SELECT text FROM comments WHERE id_event=?");
    $stmt3->execute(array($_GET['event_id']));
	$event_comments = $stmt3->fetchAll();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Event</title>
        <link rel="stylesheet" href="../css/style7.css">
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
                
            </div>
            <div id="event_comments">
                <?php 
                    foreach ($event_comments as $comment) {
                ?>
                    <div id="comment">
                        <?php echo $comment['text'];?>
                    </div>

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
        $("#add_comment").on("click", "#publish", function() {
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