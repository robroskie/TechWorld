<?php
    session_start();
    if (isset($_SESSION['user_logged_in']) == false) {
        header("Location: login.php");
        return;
    }

    function getNumberOfThreadsCreatedByUser($username) {
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

        $sql = "SELECT * FROM Threads WHERE creatorUserName = ?";
        $prepared_statement = $connection->stmt_init();
        $prepared_statement_result = $prepared_statement->prepare($sql);
        $prepared_statement->bind_param("s", $username);
        $prepared_statement->execute();
        $result_set = $prepared_statement->get_result();
        $number_of_threads = $result_set->num_rows;
        $prepared_statement->close();
        $connection->close();
        return $number_of_threads;
    }

    function getNumberOfCommentsCreatedByUser($username) {
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

        $sql = "SELECT * FROM ThreadComments WHERE creatorUserName = ?";
        $prepared_statement = $connection->stmt_init();
        $prepared_statement_result = $prepared_statement->prepare($sql);
        $prepared_statement->bind_param("s", $username);
        $prepared_statement->execute();
        $result_set = $prepared_statement->get_result();
        $number_of_threads = $result_set->num_rows;
        $prepared_statement->close();
        $connection->close();
        return $number_of_threads;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>

    <link rel="stylesheet" href="../client/css/siteStyles.css">
    <link rel="stylesheet" href="../client/css/userAccount.css">
    <link rel="stylesheet" href="../client/css/header.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include("getUserImage.php");
        include("header.php");
    ?>

    <div id="user_details_container">
        <div class="left">
            <?php
                    // Get the user's image from the database, if it does not exist, display the default no image
                    $userImageData = getUserImageFromDatabase($_SESSION['user_logged_in']);

                    if ($userImageData[0] == null || $userImageData[1] == null) {
                        echo "<img id=\"user_image\" class=\"user_img avatar-pic\" src=\"../client/img/no_user_img.png\">";
                    } else {
                        //echo "<img src=\"no_user_img.png\" style=\"width: 2em; border-radius: 1em;\">";
                        echo '<img id="user_image" class="user_img avatar-pic" src="data:'.$userImageData[0].';base64,'.base64_encode($userImageData[1]).'"/>';
                    }
            ?>
                <!--<img class="avatar-img avatar-pic" src="https://pickaface.net/gallery/avatar/unr_randomavatar_170412_0236_9n4c2i.png">-->
                <img id="user_image_overlay" class="user_img overlay" src="../client/img/edit-profile-overlay.png">
                <form id="user_image_form" action="" style="display: none;">
                    <input id="user_image_input" name="user_image_input" type="file" style="display: none;">
                </form>
        </div>

        <div class="right">
                <!---
                <h4>
                    <?php echo $_SESSION['user_logged_in'] ?>
                </h4-->

                <div class="username user-info">
                    <label for="username"><strong>Username: </strong></label>
                    <input id="username" type="text" name="username" value="<?php echo $_SESSION['user_logged_in']; ?>" readonly>
                </div>

                <!-- Get user's email -->
                <?php
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

                    $sql = "SELECT * FROM WebsiteUsers WHERE username = ?";
                    $prepared_statement = $connection->stmt_init();
                    $prepared_statement_result = $prepared_statement->prepare($sql);
                    $prepared_statement->bind_param("s", $_SESSION['user_logged_in']);
                    $prepared_statement->execute();
                    $result_set = $prepared_statement->get_result();
                    $row = $result_set->fetch_array(MYSQLI_NUM);
                    $user_email = $row[1];
                    $prepared_statement->close();
                    $connection->close();
                ?>

                
                <div class="email user-info">
                <label for="email"><strong>Email: </strong></label>
                    <input id="email" type="text" name="email" value="<?php echo $user_email; ?>" readonly="false">
                </div>
     
                <div class="user-other">
                    <div class = "posts">
                        <span class="posts"><strong>Threads</strong></span> <br>
                        <span class="post-count"><?php echo getNumberOfThreadsCreatedByUser($_SESSION['user_logged_in']); ?></span>
                    </div>
                    <div class = "likes" style="margin-left: 1em;">
                        <span class="comm"><strong>Comments</strong></span> <br>
                        <span class="comm-count"><?php echo getNumberOfCommentsCreatedByUser($_SESSION['user_logged_in']); ?></span>
                    </div>
               </div>
            
               <div style="display: flex; margin-top: 1em;">
                    <button id="edit_details_btn" class="btn btn-dark">Edit details</button>
                    <button id="cancel_changes" class="btn btn-danger" style="display: none;">Cancel</button>
                    <button id="save_changes" class="btn btn-success" style="margin-left: 1em; max-width: 15em;" style="display: none;">Save Changes</button>
               </div>

               <div id="user_info_change_error_message" class="error" style="margin-top: 1em; padding: 0.5em;"></div>
               <a href="changePassword.php" style="margin-top: 1em;">Change Password</a>
        </div>
    </div>

    <script src="../client/js/userAccount.js"></script>
</body>


</html>