<?php
    include_once('connection.php');

    $name = $_GET['name'];

    $stmt = $db->prepare("SELECT * FROM events WHERE name LIKE ?");
	$stmt->execute(array("%" . $name . "%"));
	$events = $stmt->fetchAll();

    $information = "";

    foreach($events as $event) {
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
                                
                                <div id=\"rightFooter\">
                                    <div id=\"eventJoin\">
                                        <form>
                                            <input type=\"submit\" name=\"going\" value=\"Going\" class=\"going\"/>
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