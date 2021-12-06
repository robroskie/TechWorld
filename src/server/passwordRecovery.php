<?php
session_start();


if (!isset($_SESSION['user_logged_in'])) {

} else {
    echo '"error":"attempt to create recover password when user is already logged in."';
    return;
}    

// Login credentials for database
$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "";
$database = "forum_website";

//error_reporting(0); // so if new mysqli(...) fails, an error won't be echoed to the client

// create connection
$connection = new mysqli($db_host, $db_user, $db_password, $database);

// If failed to make a connection to the database
if ($connection->connect_error) {
    echo '{"status": "Failed to make connection to database"}';
    return;
}

$username;
$email;

if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    echo '"error":"username is not in post data"';
    return;
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    echo '"error":"email is not in post data"';
    return;
}

//echo "username: " . $username;
//echo "email: " . $email;


$sql = "SELECT * FROM WebsiteUsers WHERE username = ? AND email = ?";
$prepared_statement = $connection->stmt_init();
$prepared_statement_result = $prepared_statement->prepare($sql);
if ($prepared_statement_result == false) {
    echo '{"status":"Failed to prepare statement."}';
}
$prepared_statement->bind_param("ss", $username, $email);
$prepared_statement->execute();

$result_set = $prepared_statement->get_result();

// Find how may rows were returned
$numberOfRows = $result_set->num_rows;


if ($numberOfRows == 1) {
    /*
    echo "Sending mail";
    $to = "";
    $subject = "Test Email";
    $message = "This is a test email"; 
    $result = mail($to, $subject, $message);
    if (!$result) {
        echo "failed to send mail";
        print_r(error_get_last());
    }
    */
} else {
    echo '{"status":"no match"}';
}


?>