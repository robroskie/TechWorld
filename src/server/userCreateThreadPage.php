<?php
// If there isn't a session started already, start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>MyDiscussionForum Website</title>

    <link rel="stylesheet" href="../client/css/siteStyles.css">
    <link rel="stylesheet" href="../client/css/header.css">
    <link rel="stylesheet" href="../client/css/index.css">
    <link rel="stylesheet" href="../client/css/colors.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body style="height: 100vh; display: flex; flex-direction: column;">

<?php
    include('getUserImage.php');
    include("header.php");
?>

<div id="create_thread_form_container" style="display: flex; flex-grow: 1;">
    <form id="create_thread_form" action="" style="margin: auto; padding: 0.5em; border-radius: 10px; border: 1px solid #caffbf; width: 50%; min-width: 20em;" class="fcol">
        <label for="thread_title_input" style="font-size: 2em">Thread Title</label><br>
        <input id="thread_title_input" maxlength="100" type="text" name="thread_title_input" style="width: 100%;"><br>
        <label for="thead_content_input">Thread Content</label><br>
        <textarea id="thread_content_input" maxlength="500" type="textarea" name="thread_content_input" style="width: 100%; min-height: 15em; margin-bottom: 1em;"></textarea><br>
        <label for="thread_topic_input">Thread Topic</label>
        <select id="thread_topic_input" name="thread_topic_input" id="" style="margin-bottom: 2em;">
            <option value="Other">Other</option>
            <option value="Mobile Phones">Mobile Phones</option>
            <option value="Internet">Internet</option>
            <option value="Robotics">Robotics</option>
            <option value="Computers">Computers</option>
            <option value="Physics">Physics</option>
            <option value="Math">Math</option>
        </select><br>
        <button class="btn btn-dark" style="padding: 1em;">Post Thread</button><br>
    </form>
</div>

    <script src="../client/js/userCreateThread.js"></script>

</body>
</html>

