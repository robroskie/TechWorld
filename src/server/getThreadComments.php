<?php
    session_start();

    // Login credentials for database
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_password = "";
    $database = "forum_website";

    // error_reporting(0); // so if new mysqli(...) fails, an error won't be echoed to the client

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
    $threadId = $_GET['thread'];

    if (!isset($threadId)) {
        $threadId = 1;
    }

    // -----------------------------------------------------------------------
    //    get the thread corresponding to the thread id from the get request
    // -----------------------------------------------------------------------
    $threadCommentsSQL = "SELECT * FROM ThreadComments WHERE threadId = ?";
    //echo $getThreadCardsSQL;
    // Create a prepared statement using the query and the username, execute the statement, and retrieve the results.
    $prepared_statement = $connection->stmt_init();
    $prepared_statement_result = $prepared_statement->prepare($threadCommentsSQL);
    if ($prepared_statement_result == false) {
        echo '{"status":"Failed to prepare statement."}';
    }
    $prepared_statement->bind_param("i", $threadId);
    $prepared_statement->execute();
    $result_set = $prepared_statement->get_result();

    $numberOfThreadComments = $result_set->num_rows;
    
    // Array of the ids of the thread comments that are currently displayed
    $tcIDs = array();
    //$tcIDS = "";

    ///echo "number of thread comments: " . $numberOfThreadComments;

    if ($numberOfThreadComments == 0) {
        echo "<div class=\"post_reply p1\">";
        echo    "<p class=\"post_content\">";
        echo        "This thread doesn't have any replies yet.";
        echo    "</p>";
        echo "</div>";
    }

    // Find how may rows were returned
    $threadComment = $result_set->fetch_array(MYSQLI_NUM);

    while ($threadComment != null) {

        array_push($tcIDs, $threadComment[0]);
        /*
        if ($tcIDS != "") {
            $tcIDS .= (", " . $threadComment[0]);
        } else {
            $tcIDS .= $threadComment[0];
        }
        */


        // -----------------------------------------------------------------------
        //    get the user image of the user who posted the thread if avaialable
        // -----------------------------------------------------------------------
        $userImageData = getUserImageFromDatabase($threadComment[2]);

        echo "<div class=\"post_reply p1\">";
        echo    "<p class=\"post_content\">";
        echo        $threadComment[4];
        echo    "</p>";
        echo    "<div class=\"reply_and_date_container\">";
       // echo        "<div class=\"date\">" . $threadComment[3] . "</div>";

        echo        "<div style=\"flex-grow: 1; display: flex; justify-content: right;\">";
        if ($userImageData[0] == null || $userImageData[1] == null) {
            echo            "<img src=\"../client/img/no_user_img.png\" style=\"width: 2em; border-radius: 1em;\">";
        } else {
            //echo "<img src=\"no_user_img.png\" style=\"width: 2em; border-radius: 1em;\">";
            echo            '<img style="width: 2em; border-radius: 1em;" src="data:'.$userImageData[0].';base64,'.base64_encode($userImageData[1]).'"/>';
        }
        echo                "<span style=\"margin-left: 0.5em;\">" . $threadComment[2] . "</span>";
        echo                "<span style=\"margin-left: 0.5em; margin-right: 0.5em\">|</span>";
        echo                "<span>" . $threadComment[3] . "</span>";

        echo        "</div>";
        echo    "</div>";
        echo "</div>";
        $threadComment = $result_set->fetch_array(MYSQLI_NUM);
    }
?>

<script>
    function addNewComment(content, creatorUsername, date, userImageData, userImageContentType) {
        var commentContainer = $("<div></div>").addClass("post_reply p1");
            var userInfoContainer2 = $("<div></div>").css("flex-grow", "1").css("display", "flex").css("justify-content", "right");
                var userInfoContainer = $("<div></div>");


        var userImage;
        if (userImageContentType == "" || userImageData == "") {
            console.log("no data");
            userImage = $("<img>").attr("src", "../client/img/no_user_img.png").css("width", "2em").css("border-radius", "1em");
        } else {
            userImage = $("<img>").attr("src", 'data:' + userImageContentType + ';base64,' + userImageData).css("width", "2em").css("border-radius", "1em");
        }

                    var username = $("<span></span>").css("margin-left", "0.5em").text(creatorUsername);
                    var usernameAndDateSpacer = $("<span>|</span>").css("margin-left", "0.5em").css("margin-right", "0.5em");
                    var commentDate = $("<span></span>").text(date);
        
        commentContainer.append($("<p></p>").addClass("post_content").text(content));
        commentContainer.append(userInfoContainer);
        userInfoContainer.append(userInfoContainer2).addClass("reply_and_date_container");
        userInfoContainer2.append(userImage);
        userInfoContainer2.append(username);
        userInfoContainer2.append(usernameAndDateSpacer);
        userInfoContainer2.append(commentDate);
        $("#reply_container").before(commentContainer);
    }

    function asyncLoadNewComments() {

        $.get(
            "getNewCommentsAJAX.php",

            function(data) {
                //console.log("data: " + data);
                var dataParsed = JSON.parse(data);
                //console.log("checking for new comments...");

                for (let i = 0; i < dataParsed.newComments.length; i++) {
                    addNewComment(dataParsed.newComments[i].content, dataParsed.newComments[i].creatorUserName, dataParsed.newComments[i].date, dataParsed.newComments[i].userImageData, dataParsed.newComments[i].userImageDataContentType);
                }
            }
        )
    }

    //asyncLoadNewComments();

    // Load new comments asynchronously every second
    window.setInterval(asyncLoadNewComments, 1000);

</script>


