<?php
    session_start();

    include_once("dbUtil.php");
    $connection = createDBConnection();

    if (!isset($_SESSION['user_logged_in'])) {
        header("Location: index.php");
        return;
    }

    $sql = 'SELECT * FROM WebsiteUsers WHERE admin = 1 AND username = ?';
    $stmt = $connection->prepare($sql); 
    $stmt->bind_param("s", $_SESSION['user_logged_in']);
    $stmt->execute();
    $result = $stmt->get_result();
    $number_of_results = $result->num_rows;
    
    if ($number_of_results < 1) {
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
    <title>Admin</title>
    <link rel="stylesheet" href="../client/css/admin.css">
    <link rel="stylesheet" href="../client/css/header.css">
    <link rel="stylesheet" href="../client/css/siteStyles.css">
    
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=EB+Garamond:wght@400;700&family=Montserrat&display=swap" rel="stylesheet">
    <script src="../client/js/admin.js"></script>
</head>
<body>
    <?php
        
        // ---------------------------------
        //    Session variables
        // ---------------------------------
        $_SESSION['sessionSelect'] = 'comments';

        include("getUserImage.php");
        include("header.php");
    ?>

    <div id="admin_panel_container">
        <div id="admin_panel">
            <h1 style="margin-bottom: 1em;">Admin Search for User</h1>
            <div id="admin_search_options_bar">
                <!--<img id="user_search_icon" src="images/search-image-static.png" alt="magnifying glass search icon">-->

                <input id="admin_search_bar" type="search" placeholder="user1">
                <svg id="user_search_icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>

                <div class="btn-group">
                    <!-- <button type="button" class="dropdown-toggle select_option_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Search by:
                    </button> -->
            
                        <select id="admin-box">
                            <option value="">Search By</option>
                            <option id='adminSelect' class="dropdown-item" href="#" value="username" selected>Username</option>
                            <option id='adminSelect' class="dropdown-item" href="#" value ="email">Email</option>
                            <option id='adminSelect' class="dropdown-item" href="#" value="title">Post Title</option> 
                        </select>
    

                    <!-- <div class="dropdown-menu">
                    <select name='PreviousReceiver' onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value='0'>Search by: Username</option>
                        <option value='1'>Search by: Email</option>
                        <option value='2'>Search by: Post Title</option>
                    </select>
                    </div> -->

                </div>
            </div>
            

            <div id="admin_user_search_results_container">

            <!-- <div class="user_search_result_container">
                    <div class="user_info_container">
                        <p>Username: Jesse</p>
                        <p>Email: jesse@example.com</p>
                        <p>Number of posts: 10</p>
                    </div>
                    <div class="manage_btns">
                        <button class="btn btn-outline-dark manage_user_posts_btn">
                            Manage User Posts &nbsp
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                            </svg>
                        </button>
                        <div class="btn-group user_posting_privileges">
                            <button type="button" class="dropdown-toggle select_option_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Posting: Allowed
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Unallowed</a>
                            </div>
                        </div>
                    </div>
              </div> -->

                <div class="user_search_result_container">
                    <div class="user_info_container">
                        <p>Username: <span id="username">Chris</span></p>
                        <p>Email: chris@example.com</p>
                        <p>Number of posts: 10</p>
                    </div>
                    <div class="manage_btns">
                        <button class="btn btn-outline-dark manage_user_posts_btn">
                            Manage User Posts
                             &nbsp
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                            </svg>
                        </button>
                        <div class="btn-group user_posting_privileges">
                            <button id="posting_status" type="button" class="select_option_btn" aria-haspopup="true" aria-expanded="false">Posting: Allowed</button>
                        </div>
                    </div>
                </div>

                <!-- <div class="user_search_result_container"> 
                    <div class="user_info_container">
                        <p>Username: Ally</p>
                        <p>Email: ally@example.com</p>
                        <p>Number of posts: 10</p>
                    </div>
                    <div class="manage_btns">
                            <button class="btn btn-outline-dark manage_user_posts_btn">
                                Manage User Posts &nbsp
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                </svg>
                            </button>                        <div class="btn-group user_posting_privileges">
                            <button type="button" class="dropdown-toggle select_option_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Posting: Allowed
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Unallowed</a>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</body>
</html>