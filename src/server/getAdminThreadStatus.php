<?php
    session_start();

    include_once("dbUtil.php");
    // create connection
    $connection = createDBConnection();

    // ---------------------------------
    //    POST variables
    // ---------------------------------
    $threadStatus = $_POST['threadStatus'];
    $threadID = $_POST['threadID'];

 
    // ---------------------------------
    //    Global variables
    // ---------------------------------
    $updateVal = $threadStatus != 'Show Thread' ? 1 : 0;


    echo 'Update thread status in (getAdminTreadStatus.php) '.$updateVal;
    echo "\r\n";
    echo 'thread ID  in (getAdminTreadStatus.php) '.$threadID;


    // -----------------------------------------------------------------------
    //    Perform SQL query to update database 
    // -----------------------------------------------------------------------

    $SQL = 'UPDATE threads SET threadViewStatus=? WHERE id=?';
 
    $stmt = $connection->prepare($SQL); 
    $stmt->bind_param('ii', $updateVal, $threadID);

    $status = $stmt->execute();

    $stmt->close();
