<?php
    $db = new PDO('sqlite:events.db');

    session_start();

    $stmt = $db->prepare("INSERT INTO comments (username, id_event, id_comment, text) VALUES (?, ?, NULL, ?)");
	$stmt->execute(array($_SESSION['login_user'], $_POST['id_event'], $_POST['comment']));

    $stmt2 = $db->prepare("SELECT text, username FROM comments WHERE id_event=?");
	$stmt2->execute(array($_POST['id_event']));
	$comments = $stmt2->fetchAll();

    $information = "";

    foreach ($comments as $comment) {
        $information .= "
                        <div id=\"comment\">
                            <div id=\"commentOwner\">
                                " . $comment['username'] . "
                            </div>
                            <div id=\"commentDescription\">
                                " . $comment['text'] . "
                            </div>
                        </div>
                        <hr>";
    }

    echo json_encode($information);
?>