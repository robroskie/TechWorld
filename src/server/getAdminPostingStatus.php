<?php
    session_start();

    include_once("dbUtil.php");
    // create connection
    $connection = createDBConnection();

    // ---------------------------------
    //    POST variables
    // ---------------------------------
    $postingStatus = $_POST['postingStatus'];
    $username = $_POST['username'];

    // ---------------------------------
    //    Global variables
    // ---------------------------------
    $updateVal = $postingStatus != 'Posting: Allowed' ? 0 : 1;

    // -----------------------------------------------------------------------
    //    Perform SQL query to update database 
    // -----------------------------------------------------------------------

    $SQL = 'UPDATE WebsiteUsers SET allowedToPost=? WHERE username=?';
 
    $stmt = $connection->prepare($SQL); 
    $stmt->bind_param('is', $updateVal, $username);
    $stmt->execute();



    $GLOBALS['curusername'] = $username;
    echo $GLOBALS['curusername'];


    





?>