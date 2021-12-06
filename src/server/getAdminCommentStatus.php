<?php
    session_start();

    include_once("dbUtil.php");
    // create connection
    $connection = createDBConnection();


    // ---------------------------------
    //    POST variables
    // ---------------------------------
    $commentStatus = $_POST['commentStatus'];
    $commentID = $_POST['commentID'];

 
    // ---------------------------------
    //    Global variables
    // ---------------------------------
    echo 'comment status:' . $commentStatus;

    $updateVal = $commentStatus != 'Show Comment' ? 1 : 0;


    echo 'Update comment status  '.$updateVal;
    echo "\r\n";
    echo 'comment ID   '.$commentID;


    // -----------------------------------------------------------------------
    //    Perform SQL query to update database 
    // -----------------------------------------------------------------------

    $SQL = 'UPDATE threadcomments SET commentViewStatus=? WHERE id=?';
 
    $stmt = $connection->prepare($SQL); 
    $stmt->bind_param('ii', $updateVal, $commentID);

    $status = $stmt->execute();

    $stmt->close();
