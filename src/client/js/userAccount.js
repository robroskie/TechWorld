var userAccount_username = $("#username").val();
var userAccount_email = $("#email").val();
var in_edit_mode = false;

$("#cancel_changes").css("display", "none");
$("#save_changes").css("display", "none");
$("#user_info_change_error_message").css("display", "none");

$("#edit_details_btn").on("click", function() {
    console.log("click");
    $("#username").removeAttr("readonly");
    $("#email").removeAttr("readonly");
    $("#edit_details_btn").css("display", "none");
    $("#cancel_changes").css("display", "block");
    $("#save_changes").css("display", "block");
})

$("#cancel_changes").on("click", function() {
    $("#cancel_changes").css("display", "none");
    $("#save_changes").css("display", "none");
    $("#edit_details_btn").css("display", "block");

    $("#username").val(userAccount_username);
    $("#email").val(userAccount_email);

    $("#username").attr("readonly", "true");
    $("#email").attr("readonly", "true");
})

$("#save_changes").on("click", function() {
    // Remove any previous error message
    $("#user_info_change_error_message").css("display", "none");

    $.post(
        'changeUserAccountInfo.php',
        {
            "new_username": $("#username").val(),
            "new_email": $("#email").val()
        }, 
        
        // This function is run if the request was successful
        function(data, status) {
            //console.log("made request");
            if (status == "success") {
                //console.log("data: " + data);
                dataParsed = JSON.parse(data);
                
                if (dataParsed.status == "success") {
                    //console.log("successfully changed user info");
                    window.location = "userAccount.php";
                } else {
                    $("#user_info_change_error_message").css("display", "block");
                    $("#user_info_change_error_message").text(dataParsed.error_message);
                    //console.log("error changing user info.");
                }

            } else {
                console.log('Error making ajax request to authentication.php from some file');
            }
    }).fail(function(jqxhr, textStatus, errorThrown) {
        console.log("JQuery login post request failed: " + textStatus + " - " + errorThrown);
    });
})

$("#user_image_overlay").on("click", function() {
    console.log("test!");
    $("#user_image_input").click();
})

$("#user_image_input").on("change", function(e) {

    if ($("#user_image_input")[0].files.length == 0) {
        return;
    }

    //var user_image = document.getElementById("user_image");
    $("#user_image")[0].src = URL.createObjectURL($("#user_image_input")[0].files[0]);
    var userImageFormData = new FormData($("#user_image_form")[0]);

    $.ajax(
        {
            url: "changeUserImage.php",
            contentType: false,
            data: userImageFormData,
            processData: false,
            method: "POST",
            success: function(data) {
                console.log("data: " + data);
                console.log("successful request!");
            }
        }
    );

    e.preventDefault();
})


$('.user_img').on('mouseenter', function(){
    $('.overlay').css('display', 'block');
    $('.avatar-pic').css('opacity', 0.2);
    $(".user_img").css("cursor", "pointer");
})
.on('mouseleave', function(){
    $('.overlay').css('display', 'none');
    $('.avatar-pic').css('opacity', 1);
});