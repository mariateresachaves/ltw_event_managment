<?php
    include_once('connection.php');
    include_once('niceFunctions.php');

    session_start();

    $name = $_GET['name'];

    $stmt = $db->prepare("SELECT * FROM events WHERE name LIKE ? AND visibility=0");
	$stmt->execute(array("%" . $name . "%"));
	$events = $stmt->fetchAll();

    $stmt2 = $db->prepare("SELECT id_event FROM participations WHERE participations.username=?");
	$stmt2->execute(array($_SESSION['login_user']));
	$user_participations = $stmt2->fetchAll();

    $information = "";

    foreach($events as $event) {
        $found = searchSubArray($user_participations, 'id_event', $event['id_event']);
        
        if($found == true)
            $going = "Not Going";
        else
            $going = "Going";
        
        $information .= "<div id=\"information\">
                            <div id=\"informationLeft\">
                                <div id=\"informationImg\">
                                    <a href=\"event.php?event_id=" . $event['id_event'] . "\"><img src=\"" . $event['image'] . "\" alt=\"Event Image\"></a>
                                </div>
                            </div>
                                
                            <div id=\"informationRight\">
                                <div id=\"informationName\">
                                    <a href=\"event.php?event_id=" . $event['id_event'] . "\"><h3>" . $event['name'] . "</h3></a>
                                </div>
                                
                                <div id=\"informationDescription\">
                                    <p>" . $event['description'] . "</p>
                                </div>
                                
                                <div id=\"rightFooter\">
                                    <div id=\"eventJoin\">
                                        <form class=\"eventForm\" method=\"post\">
                                            
                                            <input type=\"button\" name=\"going\" value=\"" . $going . "\" class=\"going\" id=\"" . $event['id_event'] . "\">
                                        </form>
                                    </div>

                                    <div id=\"eventOwner\">
                                        <p>" . $event['username'] . "</p>
                                    </div>
                                </div>
                            </div>
                        </div>";
    }

    if($information=="") {
        echo json_encode("No results have been found.");
    }
    else
        echo json_encode($information);
?>