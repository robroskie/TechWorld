



$("#password_recovery_form").on("submit", function(e) {
    e.preventDefault();

    if ($("#username_input").val() == "") {
        $("#username_input").addClass("error");
    }

    if ($("#email_input").val() == "") {
        $("#email_input").addClass("error");
    }

    // Make a post request to authentication.php and send the username and password the user entered
    $.post(
        'passwordRecovery.php', 
    
        {
            "username": $('#username_input').val(),
            "email": $('#email_input').val()
        }, 
        
        // This function is run if the request was successful
        function(data, status) {
            console.log("data: " + data);

    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log("JQuery login post request failed: " + textStatus + " - " + errorThrown);
    });
})