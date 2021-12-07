<?php
    function createDBConnection() {
        // Login credentials for database
        $db_host = "localhost";
        $db_user = "23217110";
        $db_password = "23217110";
        $database = "db_23217110";

        //error_reporting(0); // so if new mysqli(...) fails, an error won't be echoed to the client

        // create connection
        $connection = new mysqli($db_host, $db_user, $db_password, $database);

        // If failed to make a connection to the database
        if ($connection->connect_error) {
            echo '{"status": "Failed to make connection to database"}';
            return -1;
        }

        return $connection;
    }

    function getUserEmailFrom($username, $connection) {
        $sql = "SELECT email FROM WebsiteUsers WHERE username = ?";
        $prepared_statement = $connection->stmt_init();
        $prepared_statement_result = $prepared_statement->prepare($sql);
        $prepared_statement->bind_param("s", $username);
        $prepared_statement->execute();
        $result_set = $prepared_statement->get_result();
        $email = $result_set->fetch_array(MYSQLI_NUM)[0];
        $prepared_statement->close();
        return $email;
    }
?>