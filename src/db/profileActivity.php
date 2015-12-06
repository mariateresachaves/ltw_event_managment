<?php
    include_once('connection.php');

    session_start();

    $username = $_SESSION['login_user'];

    $stmt = $db->prepare("SELECT name, image, events.id_event, events.description FROM events, participations 
                                                    WHERE events.id_event=participations.id_event 
                                                    AND participations.username=?");
	$stmt->execute(array($username));
	$user_events = $stmt->fetchAll();

    $information = "";

    foreach($user_events as $event) {
        
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
                            </div>
                        </div>";
    }

    echo json_encode($information);
?>