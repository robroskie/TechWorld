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

    // ---------------------------------
    //    get GET variables
    // ---------------------------------
    $thread_page;
    $sort_by;
    $search_string;

    if (isset($_GET['thread_page'])) {
        $thread_page = $_GET['thread_page'];
    }
    if (isset($_GET['search_string'])) {
        $search_string = $_GET['search_string'];
    }
    if (isset($_GET['sort_by'])) {
        $sort_by = $_GET['sort_by'];
    }




    $search_string_components = null;
    if (isset($search_string)) {
        $search_string_components = explode(" ", $search_string);

        for ($i=0; $i < count($search_string_components); $i++) { 
            $search_string_components[$i] = "%" . $search_string_components[$i] . "%";
        }
    }


    $thread_search_offset = (intval($thread_page)-1) * 4; // There are four thread cards displayed per page

    if($thread_search_offset < 0) {
        $thread_search_offset = 0;
    }

    $return_thread_json = '{';

    //$return_thread_json .= '"search_string":"' . $search_string . '", ';

    // ---------------------------------------------------------------
    //    get how many threads there are for the search parameters
    // ---------------------------------------------------------------
    $getNumberOfThreadsSQL = "SELECT COUNT(*) AS NumberOfThreads FROM Threads ";

    $sql_parameters = "";
    if ($search_string_components != null && count($search_string_components) > 0) {
        $getNumberOfThreadsSQL .= "WHERE threadTitle ";
        $number_of_search_words = count($search_string_components);
        for ($i=0; $i < $number_of_search_words; $i++) { 
            $getNumberOfThreadsSQL .= "LIKE ?";
            if ($i != $number_of_search_words - 1) {
                $getNumberOfThreadsSQL .= " OR ";
            }
            $sql_parameters .= "s";
        }
    }

    $return_thread_json .= '"sql":"' . $getNumberOfThreadsSQL . '", ';

    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($getNumberOfThreadsSQL);

    if ($prepared_statement_result == false) {
        $return_thread_json .= '"status":"Failed to prepare statement."}';
        echo $return_thread_json;
        return;
    }

    if ($search_string_components != null) {
        $prepared_statement->bind_param($sql_parameters, ...$search_string_components);
    } else {
        // $prepared_statement->bind_param($sql_parameters, ...$search_string_components);
    }

    $prepared_statement->execute();
    $result_set = $prepared_statement->get_result();

    // Find how may rows were returned
    $numberOfThreadsThatMatchSearchParameters = $result_set->fetch_array(MYSQLI_NUM)[0];
    $areThreadsOnPage = $numberOfThreadsThatMatchSearchParameters >= $thread_search_offset+1;

    if (!$areThreadsOnPage) {
        $threadRemainder = ($numberOfThreadsThatMatchSearchParameters%4);
        if ($threadRemainder == 0) {
            $thread_search_offset = $numberOfThreadsThatMatchSearchParameters - 4;
        } else {
            $thread_search_offset = $numberOfThreadsThatMatchSearchParameters - $threadRemainder;
        }
        
        //echo "thread_search_offset:" . $thread_search_offset;
    }

    $return_thread_json .= '"info": {';
    $return_thread_json .= '"page_number":' . '"' . (($thread_search_offset/4)+1) . '"';
    $return_thread_json .= '}, ';











    // -----------------------------------------------------------------------------------------------------
    // Get the data for the threads which contain any of the words in the search string ($_GET['search_string'])
    // and are on the specified page ($_GET['thread_page']) (max 4 thread per page).
    //------------------------------------------------------------------------------------------------------
    $getThreadCardsSQL = "SELECT threadTitle, threadQuestion, id, date FROM Threads ";
    $sql_parameters = "";

    if ($search_string_components != null && count($search_string_components) > 0) {
        $getThreadCardsSQL .= "WHERE threadTitle ";
        $number_of_search_words = count($search_string_components);
        for ($i=0; $i < $number_of_search_words; $i++) { 
            $getThreadCardsSQL .= "LIKE ?";
            if ($i != $number_of_search_words - 1) {
                $getThreadCardsSQL .= " OR ";
            }
            $sql_parameters .= "s";
        }
    }

    $getThreadCardsSQL .= " LIMIT 4 OFFSET ? ";
    $sql_parameters .= "i";
    
    $return_thread_json .= '"sql2":"' . $getThreadCardsSQL . '", ';

    // Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($getThreadCardsSQL);
    if ($prepared_statement_result == false) {
        $return_thread_json .= '"status":"Failed to prepare statement."}';
        echo $return_thread_json;
        return;
    }

    if ($search_string_components != null && count($search_string_components) > 0) {
        array_push($search_string_components, $thread_search_offset);
        $bind_param_ok = $prepared_statement->bind_param($sql_parameters, ...$search_string_components);
    } else {
        $bind_param_ok = $prepared_statement->bind_param($sql_parameters, $thread_search_offset);
    }

    if (!$bind_param_ok) {
        echo "\n\n Error:";
        print_r($connection->error_list);
        echo "End of Error";
        $return_thread_json .= '"status":"Failed to bind paramters for prepared statement."}';
        echo $return_thread_json;
        return;
    } else {
        //echo "Ok!";
    }

    $prepared_statement->execute();
    $result_set = $prepared_statement->get_result();

    // Find how may rows were returned
    $num_rows = $result_set->num_rows;

    // If there are not enough threads so that there are threads on that page
    if ($num_rows < 1) {

    }

    $return_thread_json .= '"thread_data": [';
    // fetch_array returns an array for the next row of the results returned by the query
    $next_row = $result_set->fetch_array(MYSQLI_NUM);

    // For each thread result
    while ($next_row != null) {

        $return_thread_json .= "{";

        $return_thread_json .= "\"threadTitle\": \"" . $next_row[0] . "\", ";
        $return_thread_json .= "\"threadQuestion\": \"" . $next_row[1] . "\", ";
        $return_thread_json .= "\"id\": \"" . $next_row[2] . "\", ";
        $return_thread_json .= "\"date\": \"" . $next_row[3] . "\"";


        $return_thread_json .= "}";

        //echo "\n";
        $next_row = $result_set->fetch_array(MYSQLI_NUM);

        if ($next_row != null) {
            $return_thread_json .= ", ";
        }
    }
    $return_thread_json .= "]";
    $return_thread_json .= "}";

    echo $return_thread_json;
?>