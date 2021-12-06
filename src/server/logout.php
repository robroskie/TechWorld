<?php
    session_start();
    unset($_SESSION['user_logged_in']);
?>

<html>

    <h1>You've been logged out. Will redirect you to the home page in a moment.</h1>

<html>

<script>
    setTimeout(() => {
        window.location.href = "index.php";
    }, 3000);
</script>