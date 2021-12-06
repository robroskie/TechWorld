// Ensure document fully loaded before executing jQuery
$(document).ready(function () {

    
    $(function() {
        $('#load-nav').load('nav.php');
    });

    $('.search-img').on('click', function(){
        console.log('search clicked');
        $(this).attr('src','images/search-icon.gif');
    });

    $("#thread_search_icon").hover(function() { 
        $(this).css("cursor", "pointer") 
    }, function() { 
        $(this).css("cursor", "default") 
    });

 
    // Make left column elements yellow on hover. Remove when mouse exits element.
    $('.post_card').on('mouseenter', function(){
        $('.response-snip').css("text-decoration-style", "none");

        if(!$(this).hasClass('post_card_selected'))
            $(this).addClass('hover-element');
    })
    .on('mouseleave', function(){
        if(!$(this).hasClass('post_card_selected'))
            $(this).removeClass('hover-element');
    })
    .on('click', function(){
        $('.post_card').removeClass('post_card_selected');
        $(this).removeClass('hover-element');
        $(this).addClass('post_card_selected')
    });

    $('#page-button').on('mouseenter', function(){
            $(this).addClass('hover-element');
    })
    .on('mouseleave', function(){
            $(this).removeClass('hover-element');
    });
    
    $('.post_card').hover(function() {
        $(this).css("text-decoration", "none");
        $(this).children('.post_card_title').css("text-decoration", "underline");
        $(this).children('.post_card_title').css("color", "#0049b6");
        $(this).css("color", "#212529");
    }, function () {
        $(this).css("text-decoration", "none");
        $(this).children('.post_card_title').css("text-decoration", "none");
        $(this).children('.post_card_title').css("color", "#212529");
        $(this).css("color", "#212529");
    });

});

