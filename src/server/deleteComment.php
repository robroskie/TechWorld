<?php
    session_start();

    include_once("dbUtil.php");
    // create connection
    $connection = createDBConnection();

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
