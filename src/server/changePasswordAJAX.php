<?php
    include("dbUtil.php");

    $connection = createDBConnection();

    $oldPassword;
    $newPassword;
    $confirmNewPassword;

    if (isset($_POST['oldPassword'])) {
        $oldPassword = $_POST['oldPassword'];
    } else {
        echo '"error":"there was no oldPassword data in post request"';
        return;
    }

    if (isset($_POST['newPassword'])) {
        $newPassword = $_POST['newPassword'];
    } else {
        echo '"error":"could not get newPassword data in post request"';
        return;
    }

    if (isset($_POST['confirmNewPassword'])) {
        $confirmNewPassword = $_POST['confirmNewPassword'];
    } else {
        echo '"error":"could not get newPassword data in post request"';
        return;
    }

    //echo "newPassword" . $newPassword;
    //echo "confirmNewPassword" . $confirmNewPassword;
    
    if ($newPassword != $confirmNewPassword) {
        echo '{"status":"error", "error_message":"New password and confirm new password did not match."}';
        return;
    }

    $sql = "SELECT * FROM WebsiteUsers WHERE password = ?";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $prepared_statement->bind_param("s", md5($oldPassword));
    $prepared_statement->execute();
    $result_set = $prepared_statement->get_result();

    if ($result_set->num_rows < 1) {
        echo '{"status":"error", "error_message":"Old password is incorrect."}';
        return;
    }

    $sql = "UPDATE WebsiteUsers SET password = ? WHERE password = ?";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $prepared_statement->bind_param("ss", md5($newPassword), md5($oldPassword));
    $prepared_statement->execute();

    echo '{"status":"success"}';
?>