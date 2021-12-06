// Ensure document fully loaded before executing jQuery
$(document).ready(function () {

    $('#show-box').change(function(selected) {
        $selectedValue = $( "#show-box" ).val();
        console.log($selectedValue);
        if($selectedValue == 'comments'){
            $('#threads-container').hide();
            $('#comments-container').show();
        }
        else{
            $('#threads-container').show();
            $('#comments-container').hide();
        }
    });



    $('body').on('click', '.manage_thread', function(){
        jQuery('form', this).submit();
    });

    $('body').on('click', '.manage_comment', function(){
        jQuery('form', this).submit();
    });

    // Manage Users Post - query database and redirect to adminManageUser.php
    $('body').on('click', '.thread_status', function(){
   

        $threadID = $(this).val();

        var $this = $(this);

        $this.toggleClass('show_thread');
        if($this.hasClass('show_thread')){	
            $this.text('Show Thread');
        }
        else {
            $this.text('Hide Thread');	
        }


        console.log(`thread status in (adminManageUser.js):  ${$this.text()}`);
        console.log(`thread ID  in (adminManageUser.js) :  ${$threadID}`);

        
        // Update change for thread show status in database
        $.ajax({
            type: 'POST',
            async: false,
            url: 'getAdminThreadStatus.php',
            data: {threadStatus : $this.text(), threadID : $threadID},
            cache: false,
            // processData: false,
            // contentType: false,
            success: function (response) {
                console.log('success');
                console.log(response);
                // $this.parent('.thread_or_comment_row').remove();
            },

            error: function (response){
                console.log('error');
            }
        });
        console.log('***********');
    });

    $('body').on('click', '.remove_user', function(){
        console.log('remove thread');
        $threadID = $(this).val();

        var $this = $(this);

        // Delete thread from database
        $.ajax({
            type: 'POST',
            async: false,
            url: 'deleteThread.php',
            data: {threadID : $threadID},
            cache: false,
            // processData: false,
            // contentType: false,
            success: function (response) {
                console.log('success');
                console.log(response);
                $this.parent('.thread_or_comment_row').remove();
                window.location.reload();
            },

            error: function (response){
                console.log('error');
            }
        });
    });





    // Code for handling comments


    $('body').on('click', '.comment_status', function(){
        $commentID = $(this).val();

        var $this = $(this);

        $this.toggleClass('show_comment');
        if($this.hasClass('show_comment')){	
            $this.text('Show Comment');
        }
        else {
            $this.text('Hide Comment');	
        }

        
        // Update change for thread show status in database
        $.ajax({
            type: 'POST',
            async: false,
            url: 'getAdminCommentStatus.php',
            data: {commentStatus : $this.text(), commentID : $commentID},
            cache: false,
            // processData: false,
            // contentType: false,
            success: function (response) {
                console.log('success');
                console.log(response);
            },

            error: function (response){
                console.log('error');
            }
        });
        console.log('***********');
    });


    $('body').on('click', '.remove_comment', function(){
        console.log('remove_comments');
        $commentID = $(this).val();

        var $this = $(this);

        console.log('removing comment' + $commentID);

        // Delete thread from database
        $.ajax({
            type: 'POST',
            async: false,
            url: 'deleteComment.php',
            data: {commentID : $commentID},
            cache: false,
            // processData: false,
            // contentType: false,
            success: function (response) {
                console.log('success');
                console.log(response);
                $this.parent().parent().remove();
                // window.location.reload();
            },

            error: function (response){
                console.log('error');
            }
        });
    });






});