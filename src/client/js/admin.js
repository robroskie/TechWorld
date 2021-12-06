// Ensure document fully loaded before executing jQuery
$(document).ready(function () {
 
    $selectedValue = 'username';
    $('#admin-box').change(function(selected) {
        $selectedValue = $( "#admin-box" ).val();
        console.log($selectedValue);

    });

    //submit search bar
    $('#admin_search_bar').on('keypress', function(e){
        $lookupValue = $('#admin_search_bar').val();
    
        if(e.which == 13) {
            $( "#admin_user_search_results_container" ).empty();
            console.log(e);

            $.ajax({
                type: 'POST',
                url: 'getAdminSearch.php',
                data: {searchType : $selectedValue, lookupValue : $lookupValue},
                cache: false,
   
                success: function (response) {

                    console.log(`ajax response${response}`);
                    $('#admin_user_search_results_container').append(response);

                },
                error: function (response){
                    console.log('error');
                }
            })
        }
    });

    $('#user_search_icon').on('click', function(e){
        $lookupValue = $('#admin_search_bar').val(); 
    
            $( "#admin_user_search_results_container" ).empty();
            console.log(e);
            console.log('lookupValue is' + $lookupValue);
            console.log('selectedValue is' + $selectedValue);

            $.ajax({
                type: 'POST',
                async: false,
                url: 'getAdminSearch.php',
                data: {searchType : $selectedValue, lookupValue : $lookupValue},
                cache: false,
   
                success: function (response) {

                    console.log(`ajax response${response}`);
                    $('#admin_user_search_results_container').append(response);

                },
                error: function (response){
                    console.log('error');
                }
            })
    });

    // Manage Posting: Allowed/Disabled button
    $(document).on('click', '#posting_status', function(){
        var $username = $('#curusername');

 

        var $this = $(this);
   
        console.log($username.text());

		$this.toggleClass('Posting: Allowed');

		if($this.hasClass('Posting: Allowed')){
			$this.text('Posting: Disabled');	
        }
		 else {
			$this.text('Posting: Allowed');
        }
        console.log($this.text());

        //Update change for user in database 
        $.ajax({
            type: 'POST',
            async: false,
            url: 'getAdminPostingStatus.php',
            data: {postingStatus : $this.text(), username : $username.text()},
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
    });













    // Manage Users Post - query database and redirect to adminManageUser.php
    $(document).on('click', '#manage_user_posts', function(){
        var $username = $('#curusername');
        console.log($username);

        $("#submit-usersearch-button").submit();

        // window.location = 'adminManageUser.php';

    });

});


