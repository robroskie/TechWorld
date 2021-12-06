<?php
    session_start();

    $username;
    $userImage = $_FILES['user_image_input'];

    //var_dump($_FILES);

    if (!empty($_SESSION['user_logged_in'])) {
        $username = $_SESSION['user_logged_in'];
    } else {
        echo '{"status":"error", "error_message":"no username"}';
        return;
    }

    include("dbUtil.php");
    $connection = createDBConnection();


    // ------------------------------------------------------------------
    //      Delete previous user image from the database if it exists
    // ------------------------------------------------------------------
    $sql = "DELETE FROM UserImages WHERE username = ?";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $prepared_statement->bind_param("s", $username);
    $prepared_statement->execute();
    $prepared_statement->close();

    // ----------------------------------------------------
    //      Add user image to database if given
    // ----------------------------------------------------
    if ($userImage['error'] != UPLOAD_ERR_NO_FILE) {
        echo "adding user image to database";
        $sql = "INSERT INTO UserImages VALUES(?,?,?)";
        //$sql = "UPDATE UserImages SET imageContentType = ?, userImage = ? WHERE username = ?";
        $prepared_statement = $connection->stmt_init();
        $prepared_statement_result = $prepared_statement->prepare($sql);
        $null = NULL;
        $imgFileType = $userImage['type'];
        $prepared_statement->bind_param("ssb", $username, $imgFileType, $null);
        $imagedata = file_get_contents($userImage['tmp_name']);
        $prepared_statement->send_long_data(2, $imagedata);
        $prepared_statement->execute();
        $prepared_statement->close();
    }
    $connection->close();

    echo "done changing user image";
?>