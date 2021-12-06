<?php
    // If there isn't a session started already, start the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // If the user is not logged in then redirect them to the home page.
    if (!isset($_SESSION['user_logged_in'])) {
        header("Location: index.php");
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../client/css/changePassword.css">
    <link rel="stylesheet" href="../client/css/header.css">
    <link rel="stylesheet" href="../client/css/siteStyles.css">
    
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=EB+Garamond:wght@400;700&family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        include("getUserImage.php");
        include("header.php");
    ?>

    <div id="password_container">
        <form id="password_form" action="">
            <h1 style="margin-bottom: 1em">Change Your Password</h1>
            <label id="old_password_label" class="password_label" for="old_password">Old Password</label>
            <input id="old_password_input" class="password_text" type="password" name="old_password">
            <label class="password_label" for="new_password">New Password</label>
            <input id="new_password_input" class="password_text" type="password" name="new_password">
            <label class="password_label" for="confirm_new_password">Confirm New Password</label>
            <input id="confirm_new_password_input" class="password_text" type="password" name="confirm_new_password">
            <button id="change_password_btn" class="btn btn-dark">Submit</button>
            <span id="change_password_error_message" style="display: none; margin-top: 1em; padding: 0.5em" class="error"></span>
        </form>
    </div>

    <div id="success_change_password" style="display: none;" class="centered_panel">
        <h1>
            Successfully changed password.
        </h1>
        <a href="index.php">Click here to go back to the home page.</a>
    </div>

    <script src="../client/js/changePassword.js"></script>
</body>
</html>