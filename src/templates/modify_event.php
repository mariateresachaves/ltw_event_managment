<?php
    session_start();
    $db = new PDO('sqlite:../db/events.db');
	
	$event_id = $_GET["event_id"];

	// Stat
    $stmt_1 = $db->prepare("SELECT * FROM events_types");
    $stmt_1->execute();
    $result_1 = $stmt_1->fetchAll();

    $stmt_2 = $db->prepare('SELECT name, event_date, description, visibility FROM events WHERE id_event = ?');
    $stmt_2->execute(array($event_id));
    $result_2 = $stmt_2->fetchAll();
	
	$stmt_3 = $db->prepare('SELECT id_events_images, link FROM events_images WHERE id_event = ?');
	$stmt_3->execute(array($event_id));
	$result_3 = $stmt_3->fetchAll();

    foreach($result_2 as $event_rows)
    {
        $event_name = $event_rows[0];
        $event_date = $event_rows[1];
        $description = $event_rows[2];
		$event_privacy = $event_rows[3];
    }
	var_dump($event_privacy);
?>
<html>
  <head>
      <title>Modify your event!</title>
	  <link rel="stylesheet" href="../css/style5.css">
  </head>
  <body>
    <h1>Modify your event</h1>
    <form id="modify_event" action="../db/modify_event_submit.php" method="post" enctype="multipart/form-data">
        <label for="event_name"><br>Name of your event:<br></label>
        <input name="event_name" type="text" value="<?php echo $event_name ?>">

        <label for="event_image"><br>Pick the profile image for your event:<br></label>
		<select id="event_image" name="event_image" form="modify_event">
            <?php
            foreach($result_3 as $event_image)
            {
                echo '<option value='.$event_image['id_events_images'].'>'.$event_image['link'].'</option>';
            }
            ?>
        </select>
		
		<label for="event_images"><br>Upload more images related to your event:<br></label>
		<input id="event_images" type="file" name="event_images[]" multiple>
        
        <label for="event_description"><br>Description of your event:<br></label>
		<textarea name="event_description" form="modify_event" required ROWS=6 COLS=40><?php echo $description?></textarea>

        <label for="event_date"><br>Date of the event:<br></label>
        <input id="event_date" type="date" name="event_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $event_date ?>">

        <label for="event_type"><br>Type of event:<br></label>
        <select id="event_type" name="event_type" form="modify_event">
            <?php
            foreach($result_1 as $event_type)
            {
                echo '<option value='.$event_type['id_events_types'].'>'.$event_type['name'].'</option>';
            }
            ?>
        </select>
		
		<label for="event_privacy"><br>Privacy of your event:<br></label>
        <div id="event_privacy">
            <input type="radio" name="event_privacy" value=0 <?php echo ($event_privacy == '0')?'checked':'' ?> required> Public
            <input type="radio" name="event_privacy" value=1 <?php echo ($event_privacy == '1')?'checked':'' ?> required> Private
        </div>

		<label for="delete_event"><br> Delete event?<br></label>
        <div id="delete_event">
            <input type="radio" name="delete_event" value="Yes" required> Yes
            <input type="radio" name="delete_event" value="No" checked required> No
        </div>
		
        <input type="hidden" name="event_id" value="<?php echo $event_id?>">

        <br><input id="submit" type="submit" name="submit" value="Submit your changed event"/>
    </form>
  </body>
</html>