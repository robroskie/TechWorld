<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="../client/css/passwordRecovery.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
    <div id="password_recovery_form_container" class="fcol bc2">
        <h1>Send Recovery Email</h1>
        <form id="password_recovery_form" action="" method="post">
            <label class="password_recovery_label" for="username">Username</label>
            <input id="username_input" class="password_recovery_text form-control" type="text" name="username">
            <label class="password_recovery_label" for="email">Email</label>
            <input id="email_input" class="password_recovery_text form-control" type="text" name="email">
            <button id="send_recovery_email_btn" class="btn-dark recovery_password_btn">Send Recovery Email</button>
        </form>
    </div>

    <script src="../client/js/passwordRecovery.js"></script>
</body>
</html>