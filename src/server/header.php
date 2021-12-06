<?php
// If there isn't a session started already, start the session
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}
?>

<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-nav ml-2 mr-3">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
    </div>

    <div class="btn-group">
        <button id="select_topic_btn" type="button" class="dropdown-toggle select_option_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
                if (isset($_SESSION['topic'])) {
                    echo $_SESSION['topic'];
                } else {
                    echo "All Topics";
                    $_SESSION['topic'] = "All Topics";
                }
            ?>
        </button>
        <div class="dropdown-menu" id="topic_dropdown_menu">
            <?php
                if ($_SESSION['topic'] != "All Topics") {
                    echo "<a class=\"dropdown-item\" href=\"#\">All Topics</a>";
                }
                if ($_SESSION['topic'] != "Mobile Phones") {
                    echo "<a class=\"dropdown-item\" href=\"#\">Mobile Phones</a>";
                }
                if ($_SESSION['topic'] != "Internet") {
                    echo "<a class=\"dropdown-item\" href=\"#\">Internet</a>";
                }
                if ($_SESSION['topic'] != "Robotics") {
                    echo "<a class=\"dropdown-item\" href=\"#\">Robotics</a>";
                }
                if ($_SESSION['topic'] != "Computers") {
                    echo "<a class=\"dropdown-item\" href=\"#\">Computers</a>";
                }                
            ?>
        <div class="dropdown-divider"></div>
            <?php
                if ($_SESSION['topic'] != "Physics") {
                        echo "<a class=\"dropdown-item\" href=\"#\">Physics</a>";
                    }
                if ($_SESSION['topic'] != "Math") {
                        echo "<a class=\"dropdown-item\" href=\"#\">Math</a>";
                }
            ?>     
        </div>
    </div>

    <div class="navbar-nav ml-auto px-2" style="align-items: center; flex-direction: row;">
        <?php
            // If the user is logged in
            if(isset($_SESSION['user_logged_in'])) {

                echo "<a id=\"create_a_thread_link\" class=\"btn\" href=\"userCreateThreadPage.php\">Create a Thread";
                echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-plus\" viewBox=\"0 0 16 16\">";
                echo    "<path d=\"M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z\"/>";
                echo "</svg>";
                echo "</a>";
                // Display there username in the nav bar
                echo "<a href=\"userAccount.php\" style=\"margin-right: 1em\">";

                //include("getUserImage.php");
                // Get the user's image from the database, if it does not exist, display the default no image
                    $userImageData = getUserImageFromDatabase($_SESSION['user_logged_in']);

                    if ($userImageData[0] == null || $userImageData[1] == null) {
                        echo "<img src=\"../client/img/no_user_img.png\" style=\"width: 2em; border-radius: 1em;\">";
                    } else {
                        //echo "<img src=\"no_user_img.png\" style=\"width: 2em; border-radius: 1em;\">";
                        echo '<img style="width: 2em; border-radius: 1em;" src="data:'.$userImageData[0].';base64,'.base64_encode($userImageData[1]).'"/>';
                    }


                echo "</a>";
                echo "<a style=\"margin-right: 1em\" class=\"header_nav_link\" href=\"userAccount.php\">" . $_SESSION['user_logged_in'] . "</a>";
                // TODO
                // <a class="nav-link" href="#">Logged in profile Avatar</a>
                // Create a logout button
                echo "<a id=\"login_btn\" class=\"header_nav_link\" href=\"logout.php\">Logout</a>";
            } else {
                // Create a link to the login page
                echo "<a id=\"login_btn\" class=\"header_nav_link\" href=\"login.php\">Login</a>";
                echo "<span id=\"login_and_signup_spacer\">|</span>";
                echo "<a id=\"signup_btn\" class=\"header_nav_link\" href=\"signup.php\">Signup</a>";
            }
        ?>
    </div>
</nav>