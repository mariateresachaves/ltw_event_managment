<?php
    session_start();
    include_once('connection.php');

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

    $stmt_1 = $db->prepare("SELECT * FROM events");
    $stmt_1->execute();
    $result = $stmt_1->fetchAll();
?>
<html>
  <head>
      <title>Event registered successfully!</title>
  </head>
  <body>
    <h1>EVENT WAS ADDED SUCCESSFULLY! </h1>
  </body>
</html>
