<?php
    session_start();
    include_once('connection.php');
	
	$event_name = $_POST["event_name"];
	$event_type = $_POST["event_type"];
	$event_date = $_POST["event_date"];
	$event_description = $_POST["event_description"];
	$event_privacy = $_POST["event_privacy"];
	$null = NULL;

    $target_dir = "../imgs/".$_SESSION['login_user']."/".$event_name."/"; // Directory where the profile image for the event will be saved
    $target_file = $target_dir.basename($_FILES["image"]["name"]); // Full path of the file

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	
	// Create a directory in the images directory with path "/username/event_name" where all the images relevant to the event will be stored
	if (!file_exists($target_dir))
		mkdir("../imgs/".$_SESSION['login_user']."/".$_POST["event_name"]."/", 0755, true);
	
    if(isset($_POST["submit"]))
    {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            if (!(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)))
                echo "Sorry, there was an error uploading your file.";
        }

        else
			echo "Sorry, your file was not uploaded.";
    }
  
	// Insert the data obtained through POST method into the database regarding the event
    
    $stmt = $db->prepare('INSERT INTO events (id_event, username, id_events_types, name, image, event_date, description, visibility) VALUES (:id_event, :username, :id_events_types, :name, :image, :event_date, :description, :visibility)');
    $stmt->bindParam(':id_event', $null);
    $stmt->bindParam(':username', $_SESSION['login_user']);
    $stmt->bindParam(':id_events_types', $event_type);
    $stmt->bindParam(':name', $event_name);
    $stmt->bindParam(':image', $target_file);
    $stmt->bindParam(':event_date', $event_date);
    $stmt->bindParam(':description', $event_description);
	$stmt->bindParam(':visibility', $event_privacy);
	
    $stmt->execute();
?>
<html>
  <head>
      <title>Event registered successfully!</title>
	  <link rel="stylesheet" href="../css/style.css">
	  <meta http-equiv="refresh" content="3; url=../templates/dashboard.php"/>
  </head>
  <body>
    <h3>EVENT WAS ADDED SUCCESSFULLY!</h3>
  </body>
</html>