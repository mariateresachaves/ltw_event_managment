<?php
    session_start();
    include_once('connection.php');

    $stmt_1 = $db->prepare("SELECT * FROM events_types");
    $stmt_1->execute();
    $result_1 = $stmt_1->fetchAll();

<<<<<<< HEAD
    $stmt_2 = $db->prepare('SELECT name, image, event_date, description FROM events WHERE id_event='.$_GET["event_id"]);
    $stmt_2->execute();
    $result_2 = $stmt_2->fetchAll();

    foreach($result_2 as $event_rows)
    {
        $event_name = $event_rows[0];
        $image = $event_rows[1];
        $event_date = $event_rows[2];
        $description = $event_rows[3];
    }
?>
<html>
  <head>
      <title>Modify your event!</title>
	  <link rel="stylesheet" href="../../css/style5.css">
  </head>
  <body>
    <h1>Modify your event</h1>
    <form id="modify_event" action="../modify_event_submit.php" method="post" enctype="multipart/form-data">
        <label for="event_name"><br>Name of your event:<br></label>
        <input name="event_name" type="text" value="<?php echo $event_name ?>">

        <label for="image"><br>Pick an image for your event:<br></label>
        <input id="image" type="file" name="image">

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
=======
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
>>>>>>> origin/master
            }
            ?>
        </select>

<<<<<<< HEAD
		<label for="delete_event"><br> Delete event?<br></label>
        <div id="delete_event">
            <input type="radio" name="delete_event" value="Yes" required> Yes
            <input type="radio" name="delete_event" value="No" checked required> No
        </div>

        <input type="hidden" name="event_id" value="<?php echo $_GET["event_id"]?>">

        <br><input id="submit" type="submit" name="submit" value="Submit your changed event"/>
=======
        <div id="delete_event">
            <input type="radio" name="delete_event" value="Yes" required> Male
            <input type="radio" name="delete_event" value="No" checked required> Female
        </div>

        <input type="hidden" name="event_id" value="<?php echo $_POST["event_id"]?>">

        <input type="submit" name="submit" id="submit" value="Submit your changed event"/>
>>>>>>> origin/master
    </form>
  </body>
</html>