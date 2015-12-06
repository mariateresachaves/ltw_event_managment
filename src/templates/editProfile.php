<?php
	session_start();
    $db = new PDO('sqlite:../db/events.db');
	
	$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
	$stmt->execute(array($_SESSION['login_user']));
	$result = $stmt->fetchAll();
	
	foreach($result as $row)
	{
		$name = $row[1];
		$password = $row[2];
		$email = $row[3];
		$birthdate = $row[4];
		$gender = $row[5];
		$img = $row[8];
	}
?>
<html>
  <head>
      <title>Modify your profile!</title>
	  <link rel="stylesheet" href="../css/style2.css">
  </head>
  <body>
    <h1>Modify your profile</h1>
    <form id="modify_profile" action="../db/editProfile_submit.php" method="post" enctype="multipart/form-data">
        <label for="user_name"><br>Your name:<br></label>
        <input name="user_name" type="text" value="<?php echo $name ?>">
		
		<label for="user_image"><br>Upload a new profile picture:<br></label>
		<input id="user_image" type="file" name="user_image">
        
        <label for="user_password"><br>Pick a new password:<br></label>
		<input id="user_password" type="password" name="user_password" placeholder="New password">

        <label for="user_date"><br>Change your date of birth:<br></label>
        <input id="user_date" type="date" name="user_date" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $birthdate ?>">

        <label for="user_gender"><br>Gender:<br></label>
		<div id="gender">
			<input type="radio" name="gender" value="Male" <?php echo ($gender == 'Male')?'checked':'' ?> required> Male
			<input type="radio" name="gender" value="Female" <?php echo ($gender == 'Male')?'checked':'' ?> required> Female
		<div/>
        <br><input id="submit" type="submit" name="submit" value="Submit your changed event"/>
    </form>
  </body>
</html>
