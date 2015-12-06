<?php
	session_start();
    include_once('connection.php');

    $event_name = $_POST["event_name"];
    $event_image_id = $_POST["event_image"];
    $event_description = $_POST["event_description"];
    $event_date = $_POST["event_date"];
    $event_type = $_POST["event_type"];
	$event_privacy = $_POST["event_privacy"];
    $event_id = $_POST["event_id"];
	
	$stmt = $db->prepare("SELECT link FROM events_images WHERE id_events_images = ?");
	$stmt->execute(array($event_image_id));
	$result = $stmt->fetchAll();

    if(isset($event_name))
    {
        $stmt_1 = $db->prepare("UPDATE events SET name = '?' WHERE id_event = ?");
        $stmt_1->execute(array($event_name, $event_id));
    }

	if(isset($event_image))
	{
		$stmt_2 = $db->prepare("UPDATE events SET image = '?' WHERE id_event = ?");
		$stmt_2->execute(array($result[0][0], $event_id));
	}
	
	

	//Loop through each file
	for($i = 0; $i < count($_FILES['event_images']['name']); $i++) 
	{
			if($_FILES['event_images']['error'][$i] == UPLOAD_ERR_OK)
			{	
				//Get the temp file path
				$tmpFilePath = $_FILES['event_images']['tmp_name'][$i];
				
				//Make sure we have a filepath
				if ($tmpFilePath != "")
				{
					//Setup our new file path
					$newFilePath = "../imgs/".$_SESSION['login_user']."/".$event_name."/".basename($_FILES['event_images']['name'][$i]);
					
					//Upload the file into the temp dir
					if (!(move_uploaded_file($tmpFilePath, $newFilePath)))
						echo "Sorry, there was an error uploading your file.";
				}
				
				// Insert new images associated to event in events_images table
				$null = NULL;
				$stmt_2 = $db->prepare("INSERT INTO events_images (id_events_images, link, id_event) VALUES (:id_events_images, :link, :id_event)");
				$stmt_2->bindParam(':id_events_images', $null);
				$stmt_2->bindParam(':link', $newFilePath);
				$stmt_2->bindParam(':id_event', $event_id);
				$stmt_2->execute();
			}
	}
    if(isset($event_description))
    {
        $stmt_3 = $db->prepare("UPDATE events SET description = '?' WHERE id_event = ?");
        $stmt_3->execute(array($event_description, $event_id));
    }

    if(isset($event_date))
    {
        $stmt_4 = $db->prepare("UPDATE events SET event_date = '?' WHERE id_event = ?");
        $stmt_4->execute(array($event_date, $event_id));
    }

    if(isset($event_type))
    {
        $stmt_5 = $db->prepare("UPDATE events SET id_events_types = '?' WHERE id_event = ?");
        $stmt_5->execute(array($event_type, $event_id));
    }
	
	if(isset($event_privacy))
	{
		$stmt_6 = $db->prepare("UPDATE events SET visibility = ? WHERE id_event = ?");
		$stmt_6->execute(array($event_privacy, $event_id));
	}

    if($_POST["delete_event"] == "Yes")
    {
        $stmt_6 = $db->prepare('DELETE FROM events WHERE id_event = ?');
        $stmt_6->execute(array($event_id));
    }
?>
<html>
  <head>
      <title>Event successfully modified!</title>
	  <link rel="stylesheet" href="../css/style.css">
	  <meta http-equiv="refresh" content="3; url=../templates/dashboard.php"/>
  </head>
  <body>
    <h1>Your event has been successfully modified!</h1>
  </body>
</html>