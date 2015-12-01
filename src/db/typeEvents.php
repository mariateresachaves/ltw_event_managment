<?php
    include_once('connection.php');

    $name = $_POST['name'];

    $stmt = $db->prepare("SELECT events.* FROM events, events_types WHERE events.id_events_types = events_types.id_events_types and events_types.name=?");
	$stmt->execute(array($_POST['name']));
	$type_events = $stmt->fetchAll();

    $information = "";

    foreach($type_events as $event) {
        $information .= "<div id=\"information\">
                            <div id=\"informationLeft\">
                                <div id=\"informationImg\">
                                    <img src=\"../" . $event['image'] . "\" alt=\"Event Image\">
                                </div>
                            </div>
                                
                            <div id=\"informationRight\">
                                <div id=\"informationName\">
                                    <h3>" . $event['name'] . "</h3>
                                </div>
                                
                                <div id=\"informationDescription\">
                                    <p>" . $event['description'] . "</p>
                                </div>
                                
                                <div id=\"eventJoin\">
                                    <form>
                                        <input type=\"submit\" name=\"join\" value=\"Join\" id=\"join\"/>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }

    echo json_encode($information);
?>