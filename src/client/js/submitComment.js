


$("#submit_comment").on("click", function() {
    console.log("comment: " + $("#reply_text_area").val());
    // Make a post request to authentication.php and send the username and password the user entered
    $.post(
        'submitComment.php', 
    
        {
            "comment": $("#reply_text_area").val()
        }, 
        
        // This function is run if the request was successful
        function(data, status) {
            if (status == "success") {
                //console.log("data: " + data);
                // the jquery 'post' method returns response as a string in json format, so it needs to be parse into a javascript object.
                dataParsed = JSON.parse(data);

                //console.log("status: " + dataParsed.status);

                if (dataParsed.status == "success") {

                    var commentContainer = $("<div></div>").addClass("post_reply p1");
                        var userInfoContainer2 = $("<div></div>").css("flex-grow", "1").css("display", "flex").css("justify-content", "right");
                            var userInfoContainer = $("<div></div>");

                    console.log("user image content type: " + dataParsed.user_image_content_type);

                    var userImage;
                    if (dataParsed.user_image_content_type == "" || dataParsed.user_image_data == "") {
                        console.log("no data");
                        userImage = $("<img>").attr("src", "../client/img/no_user_img.png").css("width", "2em").css("border-radius", "1em");
                    } else {
                        userImage = $("<img>").attr("src", 'data:' + dataParsed.user_image_content_type + ';base64,' + dataParsed.user_image_data).css("width", "2em").css("border-radius", "1em");
                    }

                                var username = $("<span></span>").css("margin-left", "0.5em").text(dataParsed.username);
                                var usernameAndDateSpacer = $("<span>|</span>").css("margin-left", "0.5em").css("margin-right", "0.5em");
                                var commentDate = $("<span></span>").text(dataParsed.date);
                    
                    commentContainer.append($("<p></p>").addClass("post_content").text($("#reply_text_area").val()));
                    commentContainer.append(userInfoContainer);
                    userInfoContainer.append(userInfoContainer2).addClass("reply_and_date_container");
                    userInfoContainer2.append(userImage);
                    userInfoContainer2.append(username);
                    userInfoContainer2.append(usernameAndDateSpacer);
                    userInfoContainer2.append(commentDate);
                    $("#reply_container").before(commentContainer);

                    $("#reply_text_area").val("");
                }
    

            } else {
                console.log('Error making ajax request to authentication.php from some file');
            }
        }).fail(function(jqxhr, textStatus, errorThrown) {
            console.log("JQuery login post request failed: " + textStatus + " - " + errorThrown);
        });
})