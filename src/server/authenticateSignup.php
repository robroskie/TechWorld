<?php
session_start();

include_once("dbUtil.php");
// create connection
$connection = createDBConnection();

// Get signup form info
$username;
$email;
$password;
$confirmPassword;
$userImage = $_FILES['userProfileImg'];

if (!empty($_POST['username'])) {
    $username = $_POST['username'];
} else {
    echo '{"status":"no username"}';
    return;
}

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    echo '{"status":"no username"}';
    return;
}

if (!empty($_POST['password'])) {
    $password = $_POST['password'];
} else {
    echo '{"status":"no password"}';
    return;
}

if (!empty($_POST['confirm_password'])) {
    $confirmPassword = $_POST['confirm_password'];
} else {
    echo '{"status":"no confirm_password"}';
    return;
}


// ----------------------------------------------------
//        Check if username has already been taken
// ----------------------------------------------------
$query = "SELECT * FROM WebsiteUsers WHERE username=?";

// Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
$prepared_statement = $connection->stmt_init();
$prepared_statement_result = $prepared_statement->prepare($query);
if ($prepared_statement_result == false) {
    echo '{"status":"Failed to prepare statement."}';
}
$prepared_statement->bind_param("s", $username);
$prepared_statement->execute();
$result_set = $prepared_statement->get_result();

// Find how may rows were returned
$num_rows = $result_set->num_rows;

// If there is more than one user with the username, send that info back to the client
if ($num_rows >= 1) {
    //echo '{"status": "Username taken"}';
    echo '
    <head>
        <link rel="stylesheet" href="../client/css/userAccount.css">
    </head>
    <body style="margin: 0em; display: flex; width:100%; background: linear-gradient(to right, #FFFDE4, #005AA7) !important;">
        <div style="margin: auto; background-color: #d8e2dc; padding: 1em;">
            <h1 style="font-size: 2em; margin-bottom: 1em;">That username has already been taken.</h1>
            <a href="signup.php">Click here to go back to the signup page.</a>
        </div>
    </body>
    ';

    return;
} 

// ----------------------------------------------------
//  Check if email has already been used for another user
// ----------------------------------------------------
$query = "SELECT * FROM WebsiteUsers WHERE email=?";

// Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
$prepared_statement = $connection->stmt_init();
$prepared_statement_result = $prepared_statement->prepare($query);
if (!$prepared_statement_result) {
    echo 'Failed prepare for prepared statement';
    return;
} else {
    //echo 'Successful prepare for prepared statement';
}
if (!$prepared_statement->bind_param("s", $email)) {
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

// If there is more than one user with the username, send that info back to the client
if ($num_rows >= 1) {
    echo '
    <head>
        <link rel="stylesheet" href="../client/css/userAccount.css">
    </head>
    <body style="margin: 0em; display: flex; width:100%; background: linear-gradient(to right, #FFFDE4, #005AA7) !important;">
        <div style="margin: auto; background-color: #d8e2dc; padding: 1em;">
            <h1 style="font-size: 2em; margin-bottom: 1em;">That email is already being used by another account.</h1>
            <a href="signup.php">Click here to go back to the signup page.</a>
        </div>
    </body>
    ';
    return;
}


// ----------------------------------------------------
//         Add new user's data to the database
// ----------------------------------------------------
$sql = "INSERT INTO WebsiteUsers VALUES(?,?,?,0,1)";
$prepared_statement = $connection->stmt_init();
$prepared_statement_result = $prepared_statement->prepare($sql);
if ($prepared_statement_result == false) {
    echo '{"status":"Failed to prepare statement."}';
    return;
}

$prepared_statement->bind_param("sss", $username, $email, md5($password));

$signupSuccess = $prepared_statement->execute();
$prepared_statement->close();

if ($signupSuccess) {
    // Log the user in
    $_SESSION['user_logged_in'] = $username;
   // echo '{"status":"Successful Signup"}';
} else {
    echo '{"status":"Error inserting new user data into database"}';
}

// ----------------------------------------------------
//      Add user image to database if given
// ----------------------------------------------------
if ($userImage['error'] != UPLOAD_ERR_NO_FILE) {
    //echo "adding user image to database";
    $sql = "INSERT INTO UserImages VALUES(?,?,?)";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    $null = 0;
    $imgFileType = $userImage['type'];
    $prepared_statement->bind_param("ssb", $username, $imgFileType, $null);
    $imagedata = file_get_contents($userImage['tmp_name']);
    $prepared_statement->send_long_data(2, $imagedata);
    $prepared_statement->execute();
    $prepared_statement->close();
}

// close the connection to the database
$connection->close();

header("Location: index.php");

?>