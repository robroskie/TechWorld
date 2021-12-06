<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="navbar-nav ml-2 mr-3">
    <a class="nav-link active" aria-current="page" href="#">Home</a>
</div>

<div class="btn-group mr-5">
    <button type="button" class="btn btn-info btn-large dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Select Topic
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Printers, Scanners & Fax</a>
    <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Mobile Phones</a>
    <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Laptops and Desktops</a>
    <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Drones & Accessories</a>
    <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Wearable Technology</a>
       
    </div>
</div>

<div id="title-container" class="navbar-nav mx-auto">
    <span class="title">Tech World</span>
</div>

<div class="navbar-nav ml-auto px-2">
    <?php
        // If the user is logged in
        if(isset($_SESSION['user_logged_in'])) {
            // Display there username in the nav bar
            echo "<a class=\"nav-link\" href=\"userAccount.php\">" . $_SESSION['user_logged_in'] . "</a>";
            // TODO
            // <a class="nav-link" href="#">Logged in profile Avatar</a>
            // Create a logout button
            echo "<a id=\"login_btn\" class=\"nav-link\" href=\"logout.php\">Logout</a>";
        } else {
            // Create a link to the login page
            echo "<a id=\"login_btn\" class=\"nav-link\" href=\"login.php\">Login</a>";
            echo "<a id=\"signup_btn\" class=\"nav-link\" href=\"signup.php\">Signup</a>";
        }
    ?>
  </div>
</nav>