<?php
session_start();

// Login credentials for database
$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "";
$database = "forum_website";

error_reporting(0); // so if new mysqli(...) fails, an error won't be echoed to the client

// create connection
$connection = new mysqli($db_host, $db_user, $db_password, $database);

// If failed to make a connection to the database
if ($connection->connect_error) {
    echo '{"status": "Failed to make connection to database"}';
    return;
}

// Get username and password sent with post request
$username = $_POST['username'];
$password = $_POST['password'];

//echo "\tusername: " . $username . "\n";
//echo "\tpassword: " . $password . "\n";


$query = "SELECT password FROM WebsiteUsers WHERE username=?";
//$query = "SELECT * FROM Users";

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

// If there is more than one user with the username, an error has occured
if ($num_rows > 1) {
    echo '{"status": "Interal Server Error"}';
    return;
} 
// The username given doesn't match any users
else if ($num_rows == 0) {
    //$str = array("status"=>"Username given doesn\'t match any users", "username"=>$username);
    //echo json_encode($str);
    echo '{"status": "Invalid Login Info"}';
    return;
}

// fetch_array returns an array for the next row of the results returned by the query
$next_row = $result_set->fetch_array(MYSQLI_NUM);

while ($next_row != null) {

    foreach($next_row as $row_element) {
        // If password matches username - set session variable 'user_logged_in'
        if ($row_element == md5($password)) {
            $_SESSION['user_logged_in'] = $username;
            echo '{"status": "Successful Login"}';
            return;
        } else {
            echo '{"status": "Invalid Login Info"}';
            return;
        }
    }

    //echo "\n";
    $next_row = $result_set->fetch_array(MYSQLI_NUM);
}
?>