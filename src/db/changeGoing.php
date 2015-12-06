<?php
    include_once('connection.php');

    session_start();

    $username = $_SESSION['login_user'];

    $id_event = $_POST['id_event'];
    $going = $_POST['going'];

    if($going == "Going") {
        $stmt = $db->prepare("INSERT INTO participations (username, id_event) VALUES (?, ?)");
        $stmt->execute(array($_SESSION['login_user'], $id_event));
        
        $stmt2 = $db->prepare("SELECT name, image FROM events, participations WHERE events.id_event=participations.id_event 
                                                                               AND participations.username=?");
        $stmt2->execute(array($username));
        $events = $stmt2->fetchAll();
        
        $user_events = "";
        
        foreach($events as $event){
            
            $user_events .= "<div id=\"event\">
                                <a href=\"event.php\"><img src=\"../" . $event['image'] . "\" alt=\"User Icon\"></a>
                                <a href=\"event.php\"><p>" . $event['name'] . "</p></a>
                             </div>";
            
        }
        
        $array = ["Not Going", $user_events];
        
        echo json_encode($array);
    }
    else {
        $stmt = $db->prepare("DELETE FROM participations WHERE id_event=?");
        $stmt->execute(array($id_event));
        
        $stmt2 = $db->prepare("SELECT name, image FROM events, participations WHERE events.id_event=participations.id_event 
                                                                               AND participations.username=?");
        $stmt2->execute(array($username));
        $events = $stmt2->fetchAll();
        
        $user_events = "";
        
        foreach($events as $event){
            
            $user_events .= "<div id=\"event\">
                                <a href=\"event.php\"><img src=\"../" . $event['image'] . "\" alt=\"User Icon\"></a>
                                <a href=\"event.php\"><p>" . $event['name'] . "</p></a>
                             </div>";
            
        }
        
        $array = ["Going", $user_events];
        
        echo json_encode($array);
    }
?>