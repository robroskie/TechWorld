<?php
function getThreadPageNumber($forThreadId, $connection) { // TODO add sort by parameter
    // If failed to make a connection to the database
    if ($connection->connect_error) {
        echo '{"status": "Failed to make connection to database"}';
        return;
    }

    $sql = "SELECT * FROM (SELECT id, date, threadTitle, threadQuestion, ROW_NUMBER() OVER () thread_result_number FROM Threads) threadsTableWithRowNumbers WHERE id = ?";
    // Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    if ($prepared_statement_result == false) {
        echo '{"status":"Failed to prepare statement."}';
        echo $connection->error;
    }
    $prepared_statement->bind_param("i", $forThreadId);
    $prepared_statement->execute();
    $result_set = $prepared_statement->get_result();

    $next_row = $result_set->fetch_array(MYSQLI_NUM);

    $threadResultNumber = $next_row[0];
    //echo "threadResultNumber" . $threadResultNumber;
    $pageThreadIsOn;
    
    if ($threadResultNumber % 4 == 0) {
        $pageThreadIsOn = ($threadResultNumber/4);
    } else {
        $pageThreadIsOn = (($threadResultNumber - ($threadResultNumber%4))/4)+1;
    }

    //echo "Page thread is on: " . $pageThreadIsOn;
    return intval($pageThreadIsOn);
}
?>