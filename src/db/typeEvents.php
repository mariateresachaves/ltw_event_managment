<?php
    include_once('connection.php');
    include_once('niceFunctions.php');

    session_start();

    $name = $_POST['name'];

    $stmt = $db->prepare("SELECT events.* FROM events, events_types WHERE events.id_events_types = events_types.id_events_types and events_types.name=?");
	$stmt->execute(array($_POST['name']));
	$type_events = $stmt->fetchAll();

    $stmt2 = $db->prepare("SELECT id_event FROM participations WHERE participations.username=?");
	$stmt2->execute(array($_SESSION['login_user']));
	$user_participations = $stmt2->fetchAll();

    $information = "";

    foreach($type_events as $event) {
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
                                        <p>" . $event['event_date'] . "</p>
                                    </div>
                                </div>
                            </div>
                        </div>";
    }

    echo json_encode($information);
?>