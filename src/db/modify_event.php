<?php
    session_start();
    include_once('connection.php');

    $stmt_1 = $db->prepare("SELECT * FROM events_types");
    $stmt_1->execute();
    $result_1 = $stmt_1->fetchAll();

    $stmt_2 = $db->prepare('SELECT name, image, event_date, description FROM events WHERE id_event='.$_POST["event_id"]);
    $stmt_2->execute();
    $result_2 = $stmt_2->fetchAll();

    foreach($result_2 as $row)
    {
        $event_name = $result_2[0][0];
        $image = $result_2[0][1];
        $event_date = $result_2[0][2];
        $description = $result_2[0][3];
    }
    var_dump($result_2);
?>
<html>
  <head>
      <title>Modify your event</title>
  </head>
  <body>
    <h1>Modify your event</h1>
    <form action="modify_event_submit.php" method="post" enctype="multipart/form-data" id="modify_event">
        <label for="event_name"><br>Name of your event:<br></label>
        <input type="text" id="event_name" value="<?php echo $event_name ?>">

        <label for="image"><br>Pick an image for your event:<br></label>
        <input type="file" name="image" id="image">

        <label for="event_description"><br>Description of the event:<br></label>
        <input type="text" name="event_description" id="event_description" value="<?php echo $description ?>">

        <label for="event_date"><br>Date of the event:<br></label>
        <input type="date" name="event_date" id="event_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $event_date ?>">

        <label for="event_type"><br>Type of event:<br></label>
        <select name="event_type" id="event_type" form="modify_event">
            <?php
            foreach($result_1 as $event_type)
            {
                echo '<option value="'.$event_type['id_events_types'].'">'.$event_type[0]['name'].'</option>';
            }
            ?>
        </select>

        <div id="delete_event">
            <input type="radio" name="delete_event" value="Yes" required> Male
            <input type="radio" name="delete_event" value="No" checked required> Female
        </div>

        <input type="hidden" name="event_id" value="<?php echo $_POST["event_id"]?>">

        <input type="submit" name="submit" id="submit" value="Submit your changed event"/>
    </form>
  </body>
</html>