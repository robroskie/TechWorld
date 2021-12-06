function getThreadCardsForSearch() {
    $.get(

        "getThreadCards.php",

        {
            "thread_page": 1,
            "sort_by": "date",
            "search_string": $("#thread_search_bar").val()
        },

        function(data, status) {
            //console.log("made request");
            if (status == "success") {
                //console.log("data:" + data);
                dataParsed = JSON.parse(data);

                // set the page number
                $("#current_page").val(parseInt(dataParsed.info.page_number));
                //console.log("page number" + dataParsed.info.page_number);

                // remove all the previous pages thread cards
                $("#posts_by_topic_container").children().filter(".post_card").remove();

                //console.log(dataParsed.thread_data);
                // add the new thread cards
                for (var i = dataParsed.thread_data.length - 1; i >= 0; i--) {
                    var next_thread_card = $("<a></a>").addClass("post_card").css("text-decoration", "none").attr("href", "index.php?thread=" + dataParsed.thread_data[i].id);
                    next_thread_card.append($("<div></div>").addClass("post_card_title link").attr("href", "index.php?thread=" + dataParsed.thread_data[i].id).text(dataParsed.thread_data[i].threadTitle))
                    next_thread_card.append($("<p></p>").addClass("response-snip").css("color", "#212529").text(dataParsed.thread_data[i].threadQuestion))
                    
                    next_thread_card.hover(function() { // hover in
                        $(this).css("background-color", "#ffff66");
                        $(this).children(':nth-child(1)').css("color", "#0049b6");
                        $(this).children(':nth-child(1)').css("text-decoration", "underline");
                        //thread_content_snippet.css("color", "#000000")
                        console.log("hover out");
                    }, function() { // hover out
                        $(this).css("background-color", "#fff5f2");
                        $(this).children(':nth-child(1)').css("color", "#212529");
                        $(this).children(':nth-child(1)').css("text-decoration", "none");
                        //thread_content_snippet.css("color", "#0049b6")
                        console.log("hover out");
                    })
                    $("#sort_options_container").after(next_thread_card);
                }
            } else {
                console.log('Error making ajax request to authentication.php from some file');
            }
    }).fail(function(jqxhr, textStatus, errorThrown) {
            console.log("JQuery login post request failed: " + textStatus + " - " + errorThrown);
    });
}

$("#thread_search_icon").on("click", getThreadCardsForSearch);

$("#thread_search_bar").on("keypress", function(e) {
    if (e.key == "Enter") {
        getThreadCardsForSearch();        
    }
})