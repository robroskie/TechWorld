<?php
    session_start();

    $lastCheckTime = $_SESSION['last_check_time'];

    if(!isset($lastCheckTime)) {
        $_SESSION['last_check_time'] = new DateTime(date("Y-m-d H:i:s"));
        //echo "{\"status\":\"error\", \"error_message\":\"last_check_time session variable not set\"";
        //return;
    }

    include("dbUtil.php");
    include("getUserImage.php");

    $connection = createDBConnection();

    $sql = 'SELECT * FROM ThreadComments WHERE date > ?';
    $stmt = $connection->prepare($sql); 
    $timeOfLastNewComment = $lastCheckTime->format("Y-m-d H:i:s");
    $stmt->bind_param("s", $timeOfLastNewComment);
    $stmt->execute();
    $result = $stmt->get_result();
    $number_of_new_comments = $result->num_rows;
    $next_row = $result->fetch_assoc();
 
    $newCommentsJSON = "{ \"newComments\":[ ";



    while ($next_row != null) {

        $userImageData = getUserImageFromDatabase($next_row['creatorUserName']);

        $newCommentsJSON .= "{";

        $newCommentsJSON .= "\"content\":\"" . $next_row['content'] ."\", ";
        $newCommentsJSON .= "\"creatorUserName\":\"" . $next_row['creatorUserName'] ."\", ";
        $newCommentsJSON .= "\"date\":\"" . $next_row['date'] ."\", ";
        $newCommentsJSON .= "\"userImageData\":\"" . base64_encode($userImageData[1]) ."\", ";
        $newCommentsJSON .= "\"userImageDataContentType\":\"" . $userImageData[0] ."\"";

        $newCommentsJSON .= "}";

        $date_time_of_new_comment = new DateTime($next_row['date']);
        $date_time_of_last_new_comment_processed = $_SESSION['last_check_time'];
        
        if ($date_time_of_last_new_comment_processed < $date_time_of_new_comment) {
            $_SESSION['last_check_time'] = $date_time_of_new_comment;
        }

        $next_row = $result->fetch_assoc();
    }

    $newCommentsJSON .= "]}";

    echo $newCommentsJSON;
?>