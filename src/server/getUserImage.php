<?php


function getUserImageFromDatabase($username) {
    // Login credentials for database
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_password = "";
    $database = "forum_website";

    //error_reporting(0); // so if new mysqli(...) fails, an error won't be echoed to the client

    // create connection
    $connection = new mysqli($db_host, $db_user, $db_password, $database);

    // If failed to make a connection to the database
    if ($connection->connect_error) {
        echo '{"status": "Failed to make connection to database"}';
        return;
    }

    $imageContentType;
    $userImage;
    $sql = "SELECT imageContentType, userImage FROM UserImages where username=?";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $prepared_statement->bind_param("s", $username);
    $prepared_statement->execute();
    $prepared_statement->bind_result($imageContentType, $userImage);
    $prepared_statement->fetch();
    $prepared_statement->close();
    $imageData = array($imageContentType, $userImage);
    return $imageData;
    //echo '<img src="data:'.$type.';base64,'.base64_encode($image).'"/>';
    $connection->close();
}


?>