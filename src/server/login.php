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
    <title>Login</title>
    <link rel="stylesheet" href="../client/css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="../client/js/login.js"></script>
</head>
<body>
    <div id="login_container" class="fcol bc2">
        <h1>Log in</h1>
        <form id="login_form" action="" method="post">
            <label class="login_label" for="username">Username</label>
            <input id="username_input" class="login_text form-control" type="text" name="username">
            <label class="login_label" for="password">Password</label>
            <input id="password_input" class="login_text form-control" type="password" name="password">
            <div id="login_error_message">
            </div>
            <button class="btn-dark login_btn">Login</button>
        </form>
        <a id="sign_up_link" href="signup.php">Don't have an account? Sign up here.</a>
        <a id="sign_up_link" href="passwordRecoveryPage.php">Forgot your password? Recover it here.</a>
        <p id="notConnectedToDatabase" style="color: red; display: none;">Could not connect to database</p>
    </div>
</body>
</html>