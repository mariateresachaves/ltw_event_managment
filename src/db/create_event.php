<?php
    session_start();
    include_once('connection.php');
    $stmt_1 = $db->prepare("SELECT * FROM events_types");
    $stmt_1->execute();
    $result = $stmt_1->fetchAll();
?>
<html>
  <head>
      <title> Create an event! </title>
  </head>
  <body>
	<h1>EVENT CREATION</h1>
    <form id="create_event" action="create_event_submit.php" method="post" enctype="multipart/form-data">
        <label for="event_name"><br>Name of your event<br></label>
        <input id="event_name" type="name" name="event_name" placeholder="Choose a name for your event!">

        <label for="image"><br>Pick an image for your event:<br></label>
        <input id="image" type="file" name="image">

        <label for="event_description"><br>Description of the event:<br></label>
        <input id="event_description" type="text" name="event_description" placeholder="Write a brief description of your event..." required>

        <label for="event_date"><br>Date of the event:<br></label>
        <input id="event_date" type="date" name="event_date" min="<?php echo date('Y-m-d'); ?>" required>

        <label for="event_type"><br>Type of event:<br></label>
        <select id="event_type" name="event_type" form="create_event">
            <?php
                foreach($result as $event_type)
                {
                    echo '<option value="'.$result[0]['id_events_types'].'">'.$result[0]['name'].'</option>';
                }
            ?>
        </select>
        <br><input id="submit" type="submit" name="submit" value="Submit your event"/>
    </form>
  </body>
</html>