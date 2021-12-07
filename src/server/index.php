<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    
    <title>MyDiscussionForum Website</title>

    <link rel="stylesheet" href="../client/css/siteStyles.css">
    <link rel="stylesheet" href="../client/css/header.css">
    <link rel="stylesheet" href="../client/css/index.css">
    <link rel="stylesheet" href="../client/css/colors.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="../client/js/topicHeaderMenu.js"></script>
    <script src="../client/js/changeThreadPage.js"></script>
</head>

<body>

    <?php
        include('getUserImage.php');
        include('header.php');
    ?>

    <div id="column_container" class="column_container">
        <section id="posts_by_topic_container" class="fcol bc1">
            <div id="search_container">
                <input id="thread_search_bar" class="text_input_padding" type="search" placeholder="Search for a thread...">
               <!-- https://icons.getbootstrap.com/icons/search/ -->
                <svg id="thread_search_icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </div>

            <div id="sort_options_container">
                <div id="sort_by_search_option_btn_group" class="btn-group">
                    <button id="sort_by_search_option_btn" type="button" class="select_option_btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by: Most Recent
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Most Favourites</a>
                    </div>
                </div>
            </div>

            <?php
                include("loadThreadCards.php");
            ?>

            <div class="page-buttons">
                <button id="page_left_btn" class="page-button"><span>&#8249;</span></button>
                <input id="current_page" type="text" value="<?php include("setThreadPageNumber.php");?>" size=3>
                <button id="page_right_btn" class="page-button"><span>&#8250;</span></button>
            </div>
        </section>

        <section id="post_container" class="fcol bc2">

            <?php
                include("getThread.php");
                include("getThreadComments.php");

                // Set a session variable for what thread page the user is on so that if they submit a comment to the thread,
                // submitComment.php will know what thread it was for
                $_SESSION['thread'] = $threadId;
            ?>

            <?php
                if (isset($_SESSION['user_logged_in'])) {
                    echo "<div id=\"reply_container\">";
                    echo    "<label for=\"reply\">Write a reply:</label>";
                    echo    "<textarea name=\"reply\" id=\"reply_text_area\" cols=\"30\" rows=\"10\" maxlength=\"500\"></textarea>";
                    echo    "<button id=\"submit_comment\" class=\"btn-dark\">Submit Comment</button>";
                    echo "</div>";
                } else {
                    echo "<div id=\"reply_container\">";
                    echo    "<a href=\"login.php\">Login to write a comment to this thread.</a>";
                    echo "</div>";
                }
            ?>

        </section>
    </div>

    <footer id="footer" class="footer">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="navbar-nav ml-2 mr-3">
                <a class="nav-link active" aria-current="page" href="#">About</a>
            </div>
    
            <div class="navbar-nav ml-auto px-2">
                <a class="nav-link nav-footer" href="#">  <img class="nav-link nav-image" src="../client/img/twitter.png"> </a>
                <a class="nav-link nav-footer" href="#">  <img class="nav-link nav-image" src="../client/img/linkedin.png"> </a>
                <a class="nav-link nav-footer" href="#">  <img class="nav-link nav-image" src="../client/img/ig.png"> </a>
                <a class="nav-link active mt-1" aria-current="page" href="#">Contact</a>
            </div>
        </nav>
    </footer>

    <script src="../client/js/index.js"></script>
    <script src="../client/js/searchForThreads.js"></script>
    <script src="../client/js/submitComment.js"></script>
</body>
</html>