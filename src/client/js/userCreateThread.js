


$("#create_thread_form").on("submit", function(e) {
    e.preventDefault();

    var all_inputs_filled = true;

    console.log("thread topic: " + $("#thread_topic_input").val());

    if ($("#thread_title_input").val() == "") {
        $("#thread_title_input").addClass("error");
        all_inputs_filled = false;
    } 
    if ($("#thread_content_input").val() == "") {
        $("#thread_content_input").addClass("error");
        all_inputs_filled = false;
    }

    if (all_inputs_filled) {
        console.log("submitting data to create thread");

        $.post(
            'userCreateThread.php', 
        
            {
                "thread_title": $("#thread_title_input").val(),
                "thread_content": $("#thread_content_input").val(),
                "thread_topic": $("#thread_topic_input").val()
            }, 
            
            // This function is run if the request was successful
            function(data, status) {
                console.log("made request");
                if (status == "success") {
                    dataParsed = JSON.parse(data);

                    window.location = "index.php?thread=" + dataParsed.createdThreadId;
                } else {
                    console.log('Error making ajax request to authentication.php from some file');
                }
            }).fail(function(jqxhr, textStatus, errorThrown) {
                console.log("JQuery login post request failed: " + textStatus + " - " + errorThrown);
            });
    }

    console.log("Submit form");
})

$("#thread_title_input").on("focus", function() {
    $("#thread_title_input").removeClass("error");
})

$("#thread_content_input").on("focus", function() {
    $("#thread_content_input").removeClass("error");
})