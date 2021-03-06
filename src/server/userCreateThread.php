<?php
    session_start();


    if (isset($_SESSION['user_logged_in'])) {
        $username = $_SESSION['user_logged_in'];
    } else {
        echo '"error":"attempt to create a thread, but the user is not logged in"';
        return;
    }    

    include_once("dbUtil.php");
    // create connection
    $connection = createDBConnection();

    $thread_title;
    $thread_content;
    $thread_topic;
    $username;

    if (isset($_POST['thread_title'])) {
        $thread_title = $_POST['thread_title'];
    } else {
        echo '"error":"thread title is not in post data"';
        return;
    }

    if (isset($_POST['thread_content'])) {
        $thread_content = $_POST['thread_content'];
    } else {
        echo '"error":"thread content is not in post data"';
        return;
    }

    if (isset($_POST['thread_topic'])) {
        $thread_topic = $_POST['thread_topic'];
    } else {
        echo '"error":"thread topic is not in post data"';
        return;
    }

    if (isset($_SESSION['user_logged_in'])) {
        $username = $_SESSION['user_logged_in'];
    } else {
        echo '"error":"attempt to submit a comment, but the user is not logged in"';
        return;
    }
    

    $threadCreatedDate = date("Y-m-d H:i:s");
    $numberOfViews = 0;


    $sql = "INSERT INTO Threads (creatorUserName, date, threadTitle, threadQuestion, threadTopic, numberOfViews) VALUES (?, ?, ?, ?, ?, ?)";
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($sql);
    if ($prepared_statement_result == false) {
        echo '{"status":"Failed to prepare statement."}';
    }
    $prepared_statement->bind_param("sssssi", $username, $threadCreatedDate, $thread_title, $thread_content, $thread_topic, $numberOfViews);
    $prepared_statement->execute();

    echo '{"createdThreadId":"' . $connection->insert_id . '"}';
    //header("Location: index.php?thread=" . $connection->insert_id);
?>