<?php
    // If there isn't a session started already, start the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user_logged_in'])) {
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
    <title>signup</title>
    <link rel="stylesheet" href="../client/css/signup.css">
    <link rel="stylesheet" href="../client/css/siteStyles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="../client/js/signup.js"></script>
</head>
<body>
    <div id="signup_container" class="fcol bc2">
        <form id="signup_form" action="authenticateSignup.php" method="post" enctype="multipart/form-data">
            <h1>Sign Up</h1>
            <label class="signup_label" for="username">Username</label>
            <input id="username_input" class="signup_text form-control" type="text" name="username">

            <label class="signup_label" for="email">Email</label>
            <input id="email_input" class="signup_text form-control" type="email" name="email">
            
            <label class="signup_label" for="password">Password</label>
            <input id="password_input" class="signup_text form-control" type="password" name="password">

            <label class="signup_label" for="confirm_password">Repeat Password</label>
            <input id="confirm_password_input" class="signup_text form-control" type="password" name="confirm_password">

            <label class="signup_label" for="userProfileImg">Profile Image (Optional)</label>
            <input id="user_profile_input" type="file" name="userProfileImg" placeholder="test">
            <div id="signup_error_message">
            </div>
            <button id="signupBtn" class="btn-dark signup_btn">Signup</button>
        </form>
        
    </div>
</body>
</html>