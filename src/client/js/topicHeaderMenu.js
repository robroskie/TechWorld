

$(document).ready(function() {

    $("#topic_dropdown_menu a").on("click", function(e) {
        console.log("topic change!!" + e.target.innerText);
        $.post(
            "setTopicSessionVariable.php",
            
            {
                "topic": e.target.innerText
            },

            // This function is run if the request was successful
            function(data, status) {
                console.log("made request");
                if (status == "success") {
                    console.log("Changed topic");
                    location.reload(); // reload the page
                    //$("#select_topic_btn").text(e.target.innerText);
                    //e.target.remove();
                } else {
                    console.log('Error making ajax request to authentication.php from some file');
                }
            }).fail(function(jqxhr, textStatus, errorThrown) {
                console.log("JQuery change topic post request failed: " + textStatus + " - " + errorThrown);
            });
    });
});