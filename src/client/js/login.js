function authenticateLogin(e) {
    e.preventDefault();
    // Do Client side validation
    var usenameValidFormat = $("#username_input").val().search(/^[A-Za-z0-9]{2,30}$/);

    // If the username is not in a valid format
    if (usenameValidFormat == -1) {
        $("#login_error_message").text("The username or password you entered is not valid");
        $("#login_error_message").addClass("login_error_message_active");
    } else {
        // Hide previous error message;
        $('#notConnectedToDatabase').css("display", "none");

        // Make a post request to authentication.php and send the username and password the user entered
        $.post(
            'authentication.php', 
        
            {
                "username": $('#username_input').val(),
                "password": $('#password_input').val()
            }, 
            
            // This function is run if the request was successful
            function(data, status) {
                console.log("made request");
                if (status == "success") {
                    // the jquery 'post' method returns response as a string in json format, so it needs to be parse into a javascript object.
                    dataParsed = JSON.parse(data);

                    console.log("status: " + dataParsed.status);
        
                    if (dataParsed.status == "Failed to make connection to database") {
                        $('#notConnectedToDatabase').css("display", "block");
                    } else if (dataParsed.status == "Successful Login") {
                        console.log("Successful Login. Redirecting to main page.");
                        window.location.href = "index.php";
                    } else if (dataParsed.status == "Invalid Login Info") {
                        $("#login_error_message").text("The username or password you entered is not valid");
                        $("#login_error_message").addClass("login_error_message_active");
                    } else {
                        $("#login_error_message").text("Internal server error.");
                        $("#login_error_message").addClass("login_error_message_active");
                    }
                } else {
                    console.log('Error making ajax request to authentication.php from some file');
                }
            }).fail(function(jqxhr, textStatus, errorThrown) {
                console.log("JQuery login post request failed: " + textStatus + " - " + errorThrown);
            });
    }
}

$(document).ready(function() {
    $('#login_form').on("submit", authenticateLogin);
});