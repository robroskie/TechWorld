<?php

include_once("dbUtil.php");

function getUserImageFromDatabase($username) {
    // create connection
    $connection = createDBConnection();

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