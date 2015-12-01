<?php
    session_start();
    include_once('connection.php');
    $target_dir = "../imgs/";
    $target_file = $target_dir.$_SESSION['login_user'].basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"]))
    {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false)
			$uploadOk = 1;
        else
			$uploadOk = 0;
    }
  
	if ($uploadOk == 0)
    {
        echo "Sorry, your file was not uploaded.";
    }
    else
    {
        if (!(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)))
            echo "Sorry, there was an error uploading your file.";
    }
	// Insert the data obtained through POST method into the database regarding the event
    $null = NULL;
    $stmt = $db->prepare('INSERT INTO events (id_event, username, id_events_types, name, image, event_date, description) VALUES (:id_event, :username, :id_events_types, :name, :image, :event_date, :description)');
    $stmt->bindParam(':id_event', $null);
    $stmt->bindParam(':username', $_SESSION['login_user']);
    $stmt->bindParam(':id_events_types', $_POST["event_type"]);
    $stmt->bindParam(':name', $_POST["event_name"]);
    $stmt->bindParam(':image', $target_file);
    $stmt->bindParam(':event_date', $_POST["event_date"]);
    $stmt->bindParam(':description', $_POST['event_description']);
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