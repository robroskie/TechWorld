<?php
session_start();

// Get topic to set 'topic' session variable for
$topic = $_POST['topic'];

$_SESSION['topic'] = $topic;
?>