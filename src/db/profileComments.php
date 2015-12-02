<?php
    include_once("connection.php");

    session_start();

    $name = $_SESSION['login_user'];

    $stmt2 = $db->prepare("SELECT comments.text, events.name FROM comments, events WHERE comments.username=? AND comments.id_event=events.id_event");
    $stmt2->execute(array($name));
    $comments = $stmt2->fetchAll();

    $information = "<div id=\"rightContainerMenuBackground\">
                    </div>
                    <div id=\"rightContainerMenu\">

                            <div id=\"comments\" onclick=\"clickComments()\">
                                <h3>Comments</h3>
                            </div>
                            <div id=\"myEvents\" onclick=\"clickMyEvents()\">
                                <h3>My events</h3>
                            </div>
                            <div id=\"activity\" onclick=\"clickActivity()\">
                                <h3>Activity</h3>
                            </div>
                    </div>
                    <div id=\"commentsContainer\">
                    ";

    foreach ($comments as $comment) {
        $information .= "<div id=\"comment\">
                            <h4>" . $comment['name'] . "</h4>
                            <p>" . $comment['text'] . "</p>
                        </div>";
    }

    $information .= "</div>";

    echo json_encode($information);
?>