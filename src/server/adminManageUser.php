<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage User Posts</title>

    <link rel="stylesheet" href="../client/css/adminManageUser.css">
    <link rel="stylesheet" href="../client/css/siteStyles.css">
    <link rel="stylesheet" href="../client/css/header.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>



<?php
    include("getUserImage.php");
    include('header.php');



    // ---------------------------------
    //    Post variables
    // ---------------------------------

    if ($_POST['username_returned']) {
        $username = $_POST['username_returned'];
    }
    if ($_POST['email_returned']) {
        $email = $_POST['email_returned'];
    }


?>


    <div id="admin_manage_container">
    <h1 style="text-align: center;"> Admin Manage User</h1>
    <div id="user_details_and_search_options_container">
        <div id="user_details_container">
            <div class="username user-info">
                <span><strong>Username: </strong></span>
                <span><?php echo $username ?></span>
            </div>
            <div class="email user-info">
                <span><strong>Email: </strong></span>
                <span><?php echo $email ?></span>
            </div>
        </div>
 
            <div class="btn-group">
            <select id="show-box">
                            <option value="">Show:</option>
                            <option id='showSelect' class="dropdown-item" href="#" value="threads" selected>Show: Threads</option>
                            <option id='showSelect' class="dropdown-item" href="#" value ="comments" >Show: Comments</option>
            </select>

<!-- 
                <button type="button" class="select_option_btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Show: Threads
                </button> -->
               
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Comments</a>
                </div>
            </div>
        </div>
<?php

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



    // -----------------------------------------------------------------------
    //    SQL Query for threads
    // -----------------------------------------------------------------------

 
    $SQL = 'SELECT * FROM threads WHERE creatorUserName=?';


    // Create a prepared statement using the appropriate query
    $stmt = $connection->prepare($SQL); 
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $size = mysqli_num_rows($result);


    // Code for showing threads
    echo '<span id = "threads-container">';
    while ($row = $result->fetch_assoc()) {
        $threadStatus = $row['threadViewStatus'] != 1 ? 'Show Thread' : 'Hide Thread';
        $show_thread = $threadStatus == 'Show Thread' ? 'show_thread' : '';



        echo '<div class="thread_or_comment_row">';
        echo '<div class="user_thread_or_comment">';
        echo            '<div><strong>'.$row['threadTitle'].'</strong></div>';
        echo            '<div>'.$row['threadQuestion'].'</div>';
        echo '</div>';
        echo '<div class="thread_or_comment_options">';

        echo     '<button class="btn btn-outline-dark manage_user_btn manage_thread">';
        



        echo        '<form style="display: none" id="submit-threadsearch-button" action="index.php" method="GET">';
        echo            '<input type="hidden" id="thread" name="thread" value="'.$row["id"].'"/>';
        echo        '</form>'; 

        echo                'Goto Thread &nbsp';
        echo                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">';
        echo                   '<path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>';
        echo                   '<path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>';
        echo                '</svg>';
 
        echo    '</button>';


        
        echo '<button class="btn btn-dark manage_user_btn thread_status '.$show_thread.'" value="'.$row['id'].'">'.$threadStatus.'</button>';
        echo '<button class="btn btn-danger manage_user_btn remove_user" value="'.$row['id'].'">Remove Thread</button>';
        echo '</div>';
        echo '</div>';





    }

    echo '</span>';

    // -----------------------------------------------------------------------
    //    SQL Query for comments
    // -----------------------------------------------------------------------

 
    $SQL = 'SELECT * FROM threadcomments WHERE creatorUserName=?';


    // Create a prepared statement using the appropriate query
    $stmt = $connection->prepare($SQL); 
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $size = mysqli_num_rows($result);




    // Code for showing comments
    echo '<span id = "comments-container">';
    while ($row = $result->fetch_assoc()) {
        $commentStatus = $row['commentViewStatus'] != 1 ? 'Show Comment' : 'Hide Comment';
        $show_comment = $commentStatus == 'Show Comment' ? 'show_comment' : '';



        echo '<div class="thread_or_comment_row">';
        echo '<div class="user_thread_or_comment">';
        echo            '<div>'.$row['content'].'</div>';
        echo '</div>';
        echo '<div class="thread_or_comment_options">';

        echo     '<button class="btn btn-outline-dark manage_user_btn manage_comment">';

        // This block is used for sending the variable comment id variable to index.php
        echo        '<form style="display: none" id="submit-threadsearch-button" action="index.php" method="GET">';
        echo            '<input type="hidden" id="comment" name="comment" value="'.$row["id"].'"/>';
        echo        '</form>'; 
        echo                'Goto Comment &nbsp';
        echo                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">';
        echo                   '<path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>';
        echo                   '<path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>';
        echo                '</svg>';
        echo    '</button>';


        echo '<button class="btn btn-dark manage_user_btn comment_status '.$show_comment.'" value="'.$row['id'].'">'.$commentStatus.'</button>';
        echo '<button class="btn btn-danger manage_user_btn remove_comment" value="'.$row['id'].'">Remove Comment</button>';
        echo '</div>';
        echo '</div>';





    }







    $stmt->close();
?>



    <script src="../client/js/adminManageUser.js"></script>
</body>
</html>