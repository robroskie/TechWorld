<?php

// If there isn't a session started already, start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }

 include_once("dbUtil.php");
 // create connection
 $connection = createDBConnection();

// Get Comment from post
$threadId;
$username;
$comment;

if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
} else {
    echo '"error":"there was no comment data in post request"';
    return;
}

if (isset($_SESSION['thread'])) {
    $threadId = $_SESSION['thread'];
} else {
    echo '"error":"could not get thread id to submit comment for from session variable thread"';
    return;
}

if (isset($_SESSION['user_logged_in'])) {
    $username = $_SESSION['user_logged_in'];
} else {
    echo '"error":"attempt to submit a comment, but the user is not logged in"';
    return;
}


$addCommentToThreadSQL = "INSERT INTO ThreadComments (threadId, creatorUserName, date, content) VALUES (?, ?, ?, ?)";
$prepared_statement = $connection->stmt_init();
$commentDate = date("Y-m-d H:i:s");
$_SESSION['last_check_time'] = new DateTime($commentDate);
$prepared_statement_result = $prepared_statement->prepare($addCommentToThreadSQL);
$prepared_statement->bind_param("isss", $threadId, $username, $commentDate, $comment);
$prepared_statement->execute();

include("getUserImage.php");
$userImageData = getUserImageFromDatabase($username);

echo '{"status":"success", "date":"' . $commentDate . '", "username":"' . $username .'", "user_image_data":"' . base64_encode($userImageData[1])  . '", "user_image_content_type":"' . $userImageData[0]  . '"}';

?>