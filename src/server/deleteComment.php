<?php
    session_start();

    // Login credentials for database
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_password = "";
    $database = "forum_website";

    // error_reporting(0); // so if new mysqli(...) fails, an error won't be echoed to the client

    // create connection
    $connection = new mysqli($db_host, $db_user, $db_password, $database);

    // If failed to make a connection to the database
    if ($connection->connect_error) {
        echo '{"status": "Failed to make connection to database"}';
        return;
    }

    // ---------------------------------
    //    POST variables
    // ---------------------------------
    $commentID = $_POST['commentID'];
    echo 'thread is'.$commentID;

    // -----------------------------------------------------------------------
    //    Perform SQL query to update database 
    // -----------------------------------------------------------------------

    $SQL = 'DELETE FROM threadcomments WHERE id=?';
 
    $stmt = $connection->prepare($SQL); 
    $stmt->bind_param('i', $commentID);

    $status = $stmt->execute();

    $stmt->close();
