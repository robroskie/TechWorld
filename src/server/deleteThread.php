<?php
    session_start();

    include_once("dbUtil.php");
    // create connection
    $connection = createDBConnection();

    // ---------------------------------
    //    POST variables
    // ---------------------------------
    $threadID = $_POST['threadID'];
    echo 'thread is'.$threadID;
    // -----------------------------------------------------------------------
    //    Perform SQL query to update database 
    // -----------------------------------------------------------------------

    $SQL = 'DELETE FROM threads WHERE id=?';
 
    $stmt = $connection->prepare($SQL); 
    $stmt->bind_param('i', $threadID);

    $status = $stmt->execute();

    $stmt->close();
