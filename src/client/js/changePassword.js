

$("#password_form").on("submit", function(e) {
    e.preventDefault();
    $("#change_password_error_message").css("display", "none");
    $("#success_change_password").css("display", "none");

    $.post(
        'changePasswordAJAX.php', 
    
        {
            "oldPassword": $('#old_password_input').val(),
            "newPassword": $('#new_password_input').val(),
            "confirmNewPassword": $('#confirm_new_password_input').val()
        }, 
        
        function(data, status) {
            if (status == "success") {
                console.log("data: " + data);
                dataParsed = JSON.parse(data);

                console.log("status: " + dataParsed.status);
    
                if (dataParsed.status == "success") {
                    $("#password_container").css("display", "none");
                    $("#success_change_password").css("display", "block");
                } else if (dataParsed.status == "error") {
                    $("#change_password_error_message").css("display", "block");
                    $("#change_password_error_message").text(dataParsed.error_message);
                }

            } else {
                console.log('Error making ajax request to authentication.php from some file');
            }
        }).fail(function(jqxhr, textStatus, errorThrown) {
            console.log("JQuery login post request failed: " + textStatus + " - " + errorThrown);
        });
})