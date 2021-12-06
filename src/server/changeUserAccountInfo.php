<?php
    session_start();
    if (isset($_SESSION['user_logged_in']) == false) {
        header("Location: login.php");
        return;
    }

    include("dbUtil.php");

    $connection = createDBConnection();

    if (!isset($_POST['new_username'])) { echo '{"status":"error", "error_message":"no username"}'; return; }
    if (!isset($_POST['new_email'])) { echo '{"status":"error", "error_message":"no email"}'; return; }
    if (!isset($_SESSION['user_logged_in'])) { echo '{"status":"error", "error_message":"user not logged in"}'; return; }

    $users_email = getUserEmailFrom($_SESSION['user_logged_in'], $connection);

// ----------------------------------------------------
//        Check if username has already been taken
// ----------------------------------------------------
$query = "SELECT * FROM WebsiteUsers WHERE username = ? AND username <> ?";

// Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
$prepared_statement = $connection->stmt_init();
$prepared_statement_result = $prepared_statement->prepare($query);
if ($prepared_statement_result == false) {
    echo '{"status":"Failed to prepare statement."}';
}
$prepared_statement->bind_param("ss", $username, $_SESSION['user_logged_in']);
$prepared_statement->execute();
$result_set = $prepared_statement->get_result();

// Find how may rows were returned
$num_rows = $result_set->num_rows;

// If there is more than one user with the username, send that info back to the client
if ($num_rows >= 1) {
    echo '{"status":"error", "error_message":"That username has already taken."}';
    return;
} 

// ----------------------------------------------------
//  Check if email has already been used for another user
// ----------------------------------------------------
$query = "SELECT * FROM WebsiteUsers WHERE email = ? AND email <> ?";

// Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
$prepared_statement = $connection->stmt_init();
$prepared_statement_result = $prepared_statement->prepare($query);
if (!$prepared_statement_result) {
    echo 'Failed prepare for prepared statement';
    return;
} else {
    //echo 'Successful prepare for prepared statement';
}
if (!$prepared_statement->bind_param("ss", $_POST['new_email'], $users_email)) {
    echo 'Failed bind_param for prepared statement';
    return;
} else {
    //echo 'Successful bind_param for prepared statement';
}
if (!$prepared_statement->execute()) {
    echo 'Failed to execute prepared statement.';
    return;
} else {
    //echo 'Successfully executed prepared statement.';
}
$result_set = $prepared_statement->get_result();

// Find how may rows were returned
$num_rows = $result_set->num_rows;

// If there is more than one user with the email, send an error message back
if ($num_rows >= 1) {
    echo '{"status":"error", "error_message":"That email has already been used by another account."}';
    return;
}

    //echo "user logged in: " . $_SESSION['user_logged_in'];
    //echo "new_username: " . $_POST['new_username'];
    //echo "new_email: " . $_POST['new_email'];


    // ------------------------------------------------------------------
    //  Update the user's info to the new info in the WebsiteUsers table
    // ------------------------------------------------------------------
    $sql = "UPDATE WebsiteUsers SET username = ?, email = ? WHERE username = ?";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $prepared_statement->bind_param("sss", $_POST['new_username'], $_POST['new_email'], $_SESSION['user_logged_in']);
    $prepared_statement->execute();
    $prepared_statement->close();

    // ------------------------------------------------------------------
    //  Update the user's info to the new info in the Threads table
    // ------------------------------------------------------------------
    $sql = "UPDATE Threads SET creatorUserName = ? WHERE creatorUserName = ?";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $prepared_statement->bind_param("ss", $_POST['new_username'], $_SESSION['user_logged_in']);
    $prepared_statement->execute();
    $prepared_statement->close();

    // ------------------------------------------------------------------
    //  Update the user's info to the new info in the ThreadComments table
    // ------------------------------------------------------------------
    $sql = "UPDATE ThreadComments SET creatorUserName = ? WHERE creatorUserName = ?";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $prepared_statement->bind_param("ss", $_POST['new_username'], $_SESSION['user_logged_in']);
    $prepared_statement->execute();
    $prepared_statement->close();

    // ------------------------------------------------------------------
    //  Update the user's info to the new info in the UserImages table
    // ------------------------------------------------------------------
    $sql = "UPDATE UserImages SET username = ? WHERE username = ?";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $prepared_statement->bind_param("ss", $_POST['new_username'], $_SESSION['user_logged_in']);
    $prepared_statement->execute();
    $prepared_statement->close();

    $connection->close();

    $_SESSION['user_logged_in'] = $_POST['new_username'];

    echo '{"status":"success"}';
?>