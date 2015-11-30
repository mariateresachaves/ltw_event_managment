<?php
    include_once('connection.php');

    $event_name = $_POST["event_name"];
    $image = $_FILES["image"];
    $event_description = $_POST["event_description"];
    $event_date = $_POST["event_date"];
    $event_type = $_POST["event_type"];
    $event_id = $_POST["event_id"];

    if(isset($event_name))
    {
        $stmt_1 = $db->prepare('UPDATE events SET name='.$event_name.'WHERE id_event='.$event_id);
        $stmt_1->execute();
    }

    if(isset($image))
    {
        $target_dir = "../imgs/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        var_dump($target_file);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"]))
        {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false)
            {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            }
            else
            {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000)
        {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0)
        {
            echo "Sorry, your file was not uploaded.";
        }
        else
        {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
            {
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            }
            else
            {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $stmt_2 = $db->prepare('UPDATE events SET image='.$target_file.'WHERE id_event='.$event_id);
        $stmt_2->execute();
    }

    if(isset($event_description))
    {
        $stmt_3 = $db->prepare('UPDATE events SET description='.$event_description.'WHERE id_event='.$event_id);
        $stmt_3->execute();
    }

    if(isset($event_date))
    {
        $stmt_4 = $db->prepare('UPDATE events SET event_date='.$event_date.'WHERE id_event='.$event_id);
        $stmt_4->execute();
    }

    if(isset($event_description))
    {
        $stmt_5 = $db->prepare('UPDATE events SET id_events_types='.$event_type.'WHERE id_event='.$event_id);
        $stmt_5->execute();
    }

    if($_POST["delete_event"] == "Yes")
    {
        $stmt_6 = $db->prepare('DELETE FROM events WHERE id_event='.$event_id);
        $stmt_6->execute();
    }

?>
<html>
  <head>
      <title>Event successfully modified!</title>
  </head>
  <body>
    <h1>Your event has been successfully modified!</h1>
  </body>
</html>