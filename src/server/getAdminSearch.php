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
    $searchType = $_POST['searchType'];
    $lookupValue = $_POST['lookupValue'];

    // ---------------------------------
    //    Global variables
    // ---------------------------------
    $username_returned;
    $email_returned;
    $postingStatus;

    // -----------------------------------------------------------------------
    //    Modify sql query depending on whether username/email or title search requested
    // -----------------------------------------------------------------------
    $title_search = false;
    $SQL = "";
    if(!strstr($searchType, 'title')){
        $SQL = 'SELECT * FROM WebsiteUsers WHERE '. $searchType.'=?';
    }
    else{
        $SQL = 'SELECT * FROM threads WHERE threadTitle=?';
        $title_search = true;
    }


    // Create a prepared statement using the appropriate query
    $stmt = $connection->prepare($SQL); 
    $stmt->bind_param("s", $lookupValue);
    $stmt->execute();
    $result = $stmt->get_result();
    $size = mysqli_num_rows($result);

    // Extract and save useful information from the query
    while ($row = $result->fetch_assoc()) {
        if($title_search){
            $username_returned = $row['creatorUserName'];
        }
        else{
            $username_returned = $row['username'];
            $email_returned = $row['email'];
        }

    }

    // Handle cases where no match is found in database
    if ($size==0 && strstr($searchType, 'username')) { 
        echo    '<div class="user_search_result_container">';
        echo    '<div class="user_info_container">';
        echo    '<p>Username: '.$lookupValue.' does not exist.</p>';
        echo    '</div>';
        echo    '</div>';
    }
    elseif ($size==0 && strstr($searchType, 'email')){  
        echo    '<div class="user_search_result_container">';
        echo    '<div class="user_info_container">';
        echo    '<p>User does not exist with email: '.$lookupValue.'';
        echo    '</div>';
        echo    '</div>';
    }
    elseif($size==0 && strstr($searchType, 'title')){
        echo    '<div class="user_search_result_container">';
        echo    '<div class="user_info_container">';
        echo    '<p>No threads exist with the title: '.$lookupValue.'';
        echo    '</div>';
        echo    '</div>';
    }
    // Match found in database
    else{
        if(!$title_search){

            $stmt = $connection->prepare($SQL); 
            $stmt->bind_param("s", $lookupValue);
            $stmt->execute();
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $username_returned = $row['username'];
                $email_returned = $row['email'];
                $postingStatus = $row['allowedToPost'];
            }
        }
        else{
            $SQL = 'SELECT * FROM WebsiteUsers WHERE username=?';
            $stmt = $connection->prepare($SQL); 
            echo $username_returned;
            $stmt->bind_param("s", $username_returned);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $username_returned = $row['username'];
                $email_returned = $row['email'];
                $postingStatus = $row['allowedToPost'];
            }
        }
 
        $SQL = 'SELECT * FROM WebsiteUsers WHERE username=?';
        $stmt = $connection->prepare($SQL); 
   
        $stmt->bind_param("s", $username_returned);
        $stmt->execute();
        $result = $stmt->get_result();

        // Get number of rows 
        $SQL = 'SELECT * FROM threads WHERE creatorUserName=?';
        $stmt = $connection->prepare($SQL); 

        $stmt->bind_param("s", $username_returned);
        $stmt->execute();
        $result = $stmt->get_result();

        $postingStatusString = $postingStatus == 1 ? 'Posting: Allowed' : 'Posting: Disabled';

        $GLOBALS['currentusername'] = $username_returned;

    

        // Output to fulfill ajax request
        echo    '<div class="user_search_result_container">';
        echo    '<div class="user_info_container">';
        echo        '<p>Username: <span id="curusername">'.$username_returned.'</span></p>';
        echo        '<p>Email: '.  $email_returned.'</p>';
        echo        '<p>Number of posts:  '. mysqli_num_rows($result). '</p>';
        echo        '</div>';

 
        
        echo        '<div class="manage_btns">';
        
        echo        '<form style="display: none" id="submit-usersearch-button" action="adminManageUser.php" method="POST" id="form">';
        echo            '<input type="hidden" id="username_returned" name="username_returned" value="'.$username_returned.'"/>';
        echo            '<input type="hidden" id="email_returned" name="email_returned" value="'.$email_returned.'"/>';
        echo        '</form>';

        echo            '<button id="manage_user_posts" class="btn btn-outline-dark manage_user_posts_btn">';
        echo                'Manage User Posts &nbsp';
        echo                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">';
        echo            '<path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>';
        echo             '<path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>';
        echo            '</svg>';
        echo            '</button>';
        
  
        
        echo     '<div class="btn-group user_posting_privileges">';
        echo     '<button id="posting_status" type="button" class="select_option_btn" aria-haspopup="true" aria-expanded="false">'.$postingStatusString.'</button>';
        echo        '</div>';
        echo   '</div>';
        echo    '</div>';
        echo   '</div>';
        
    }






    





?>