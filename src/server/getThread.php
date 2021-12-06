<?php
    session_start();

    include_once("dbUtil.php");
    // create connection
    $connection = createDBConnection();

    // ---------------------------------
    //    get GET variables
    // ---------------------------------
    $threadId = $_GET['thread'];

    if (!isset($threadId)) {
        $threadId = 1;
    }

    // -----------------------------------------------------------------------
    //    get the thread corresponding to the thread id from the get request
    // -----------------------------------------------------------------------
    $threadSQL = "SELECT * FROM Threads WHERE id = ?";
    //echo $getThreadCardsSQL;
    // Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($threadSQL);
    if ($prepared_statement_result == false) {
        echo '{"status":"Failed to prepare statement."}';
    }
    $prepared_statement->bind_param("i", $threadId);
    $prepared_statement->execute();
    $result_set = $prepared_statement->get_result();

    // Find how may rows were returned
    $thread = $result_set->fetch_array(MYSQLI_NUM);

    // -----------------------------------------------------------------------
    //    get the user image of the user who posted the thread if avaialable
    // -----------------------------------------------------------------------
    $userImageData = getUserImageFromDatabase($thread[1]);

    echo "<div class=\"post_selected p1\" id=\"thread_container\">";

    echo    "<h1 class=\"post_title fs2\">" . $thread[3] . "</h1>";
    echo    "<p class=\"post_content\">";
    echo    $thread[4];
    echo    "</p>";
    echo    "<div class=\"reply_and_date_container\">";
    echo            "<a class=\"reply_btn\" href=\"#reply_text_area\">Reply</a>";

    echo    "<div style=\"flex-grow: 1; display: flex; justify-content: right;\">";
    if ($userImageData[0] == null || $userImageData[1] == null) {
        echo        "<img src=\"../client/img/no_user_img.png\" style=\"width: 2em; border-radius: 1em;\">";
    } else {
        //echo "<img src=\"no_user_img.png\" style=\"width: 2em; border-radius: 1em;\">";
        echo        '<img style="width: 2em; border-radius: 1em;" src="data:'.$userImageData[0].';base64,'.base64_encode($userImageData[1]).'"/>';
    }
    echo            "<span style=\"margin-left: 0.5em;\">" . $thread[1] . "</span>";
    echo            "<span style=\"margin-left: 0.5em;\"> | &nbsp &nbsp" . $thread[2] . "</span>";
    echo    "</div>";

        
    echo     "</div>";
    echo "</div>";

?>