<?php
    // If there isn't a session started already, start the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

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

    include("getThreadPageForThreadId.php");

    $threadId = $_GET['thread'];
    $sort_by = $_GET['sort_by'];

    if (!isset($threadId)) {
        $threadId = 1;
    }

    $thread_page = getThreadPageNumber($threadId, $connection); // TODO add sort by
    $thread_search_offset = (intval($thread_page)-1) * 4; // There are four thread cards displayed per page

    if($thread_search_offset < 0) {
        $thread_search_offset = 0;
    }

    //$return_thread_json .= '"page_number":' . '"' . (($thread_search_offset/4)+1) . '"';


    $getThreadCardsSQL = "SELECT threadTitle, threadQuestion, id, date FROM Threads LIMIT 4 OFFSET ?";
    // Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($getThreadCardsSQL);
    if ($prepared_statement_result == false) {
        echo '{"status":"Failed to prepare statement."}';
    }
    $prepared_statement->bind_param("i", $thread_search_offset);
    $prepared_statement->execute();
    $result_set = $prepared_statement->get_result();

    // Find how may rows were returned
    $num_rows = $result_set->num_rows;


    // fetch_array returns an array for the next row of the results returned by the query
    $next_row = $result_set->fetch_array(MYSQLI_NUM);

    // For each thread result
    while ($next_row != null) {
        echo "<a class=\"post_card\" href=\"index.php?thread=" . $next_row[2]  . "\">";
        echo "<div class=\"post_card_title link\">";
            echo $next_row[0];
        echo "</div>";
        echo "<p class=\"response-snip\">";
            echo $next_row[1];
        echo "</p>";
        echo "</a>";
        $next_row = $result_set->fetch_array(MYSQLI_NUM);
    }

?>