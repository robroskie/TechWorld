function authenticateSignup(e) {
    //e.preventDefault();

    // Hide previous error message
    $('#notConnectedToDatabase').css("display", "none");
    console.log("signup!");

    var notAllFormInputIsValid = false;

    // Do Client side validation
    var usenameInvalidFormat = $("#username_input").val().search(/^.{2,30}$/) == -1 ? true : false;
    var emailInvalidFormat = $("#email_input").val().search(/^.*@.*\..*$/) == -1 ? true : false;
    var passwordInvalidFormat = $("#password_input").val().search(/^.{1,30}$/) == -1 ? true : false;
    var confirmPasswordInvalidFormat = $("#confirm_password_input").val().search(/^.{1,30}$/) == -1 ? true : false;

    if (usenameInvalidFormat) {
        $("#username_input").addClass("error");
        $("#username_input").attr("placeholder", "2-30 characters")
        notAllFormInputIsValid = true;
    }

    if (emailInvalidFormat) {
        $("#email_input").addClass("error");
        $("#email_input").attr("placeholder", "Not a valid email format")
        notAllFormInputIsValid = true;
    }

    if (passwordInvalidFormat) {
        $("#password_input").addClass("error");
        $("#password_input").attr("placeholder", "password must be 2 - 30 characters")
        notAllFormInputIsValid = true;
    }

    if (confirmPasswordInvalidFormat) {
        $("#confirm_password_input").addClass("error");
        $("#confirm_password_input").attr("placeholder", "password must be 2 - 30 characters")
        notAllFormInputIsValid = true;
    }

    if ($("#password_input").val() != $("#confirm_password_input").val()) {
        $("#signup_error_message").text("Passwords do not match");
        $("#signup_error_message").addClass("signup_error_message_active");
        $("#confirm_password_input").addClass("error");
        $("#password_input").addClass("error");
        console.log("here!");
        e.preventDefault();
        return;
    } else if (notAllFormInputIsValid) {
        $("#signup_error_message").text("Not all form inputs have valid input");
        $("#signup_error_message").addClass("signup_error_message_active");
        e.preventDefault();
        return;
    }

    /*
    // Make a post request to authentication.php and send the signup form data
    $.post(
        'authenticateSignup.php', 
    
        {
            "username": $('#username_input').val(),
            "email": $('#email_input').val(),
            "password": $('#password_input').val(),
            "confirm_password": $('#confirm_password_input').val()
        }, 
        
        // This function is run if the request was successful
        function(data, status) {
            console.log("made request");
            if (status == "success") {
                console.log("data: " + data);
                // the jquery 'post' method returns response as a string in json format, so it needs to be parse into a javascript object.
                dataParsed = JSON.parse(data);

                console.log("status: " + dataParsed.status);
    
                if (dataParsed.status == "Failed to make connection to database") {
                    $('#notConnectedToDatabase').css("display", "block");
                } else if (dataParsed.status == "Successful Signup") {
                    console.log("Successful Signup. Redirecting to main page.");
                    window.location.href = "index.php";
                } else if (dataParsed.status == "Username taken") {
                    $("#signup_error_message").text("That username is already taken.");
                    $("#signup_error_message").addClass("signup_error_message_active");
                } else if (dataParsed.status == "Email taken") {
                    $("#signup_error_message").text("That email is already taken.");
                    $("#signup_error_message").addClass("signup_error_message_active");
                } else {
                    $("#signup_error_message").text("Internal server error.");
                    $("#signup_error_message").addClass("signup_error_message_active");
                }
            } else {
                console.log('Error making ajax request to authentication.php from some file');
            }
    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log("JQuery login post request failed: " + textStatus + " - " + errorThrown);
    });
    */
}

$(document).ready(function() {
    $('#signup_form').on("submit", authenticateSignup);


    $("#username_input").on("focus", function() {
        $("#username_input").removeClass("error");
    })


    $("#email_input").on("focus", function() {
        $("#email_input").removeClass("error");
    })


    $("#password_input").on("focus", function() {
        $("#password_input").removeClass("error");
    })


    $("#confirm_password_input").on("focus", function() {
        $("#confirm_password_input").removeClass("error");
    })

});