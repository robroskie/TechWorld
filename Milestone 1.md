# Team members:
- Jacob Harding
- Luke Roblesky

# Project description:
The goal for our project is to make a forum website where registered users can create message threads on tech related topics and reply to other users on different threads.

## **General Site Features**
- A home page with a two column layout which contains the posts for the topic selected via the navbar on the left and the current selected post from this list displayed on the right 
- There will be a main navigation bar at the top of the site where users can access the different pages of the site, like the login or logout page, the home page, their favourites page and profile information
- A page per post where a registered user can view all the replies to a post and  make replies to the post topic
Each post will show which user made it and on which date

## **Users** 
### All users
- All users, registered or not, can search for posts using the site’s search bar
- There will be a register page where new users can register using an email address and providing a password and optionally provide a user profile image

### Registered Users
- There will be a login page where registered users can login giving them access to other features on the site such as posting and their user-specific pages.
- If a registered user forgets their password, they will have the option to click a button which will send a password recovery email to their user email address.
- Registered users will be allowed to create posts with a title and main post text content/question
- Registered users will also have the option for up voting or downvoting other posts and creating reply posts to a main post.
- Registered users will also have access to an account page where they can edit and view their user account information 
- Registered users will have the option to favourite a post and view all their favorite posts on a specific page.
- Registered users can add tags to their posts and search for posts by tag 

### Administrators 
- Will have all the same privileges as a registered user
- Will have access to a page for viewing all site users where they can also search for specific users
- On the same page they will have the option for removing user accounts, edit/remove items and comments and/or reducing user privileges such as posting.

## **Technical Features**
- **Front end**
- Build a website layout using HTML, CSS and Bootstrap frameworks 
- Make the menus reflect changes in state (user logged in, navigates to different page etc.)
- Make the website responsive to window resizing, friendly for viewing on desktop screens, tablets and phones and usable by those with visual disabilities using a combination of - proper HTML semantic markup, CSS and JS
- Using JavaScript, validate on the client side registration and log in forms to ensure prior to submission that:
    - Email address includes “@” symbol 
    - Username is between 7 - 11 characters and includes both letters and numbers 
    - Username does not match any strings from list of inappropriate words 
    - Password is between 8 - 15 characters and includes both letters and numbers 
- User states for both users and administrators will be maintained 	
- Asynchronous updates will be made using AJAX and will be reflected on threads for all users without the need to refresh the page
- These new items will appear in a different color to notify the user of their existence and will return to the standard color after the user scrolls over them with the mouse 
- For small browsers (exact dimensions to be determined) the layout will switch from the two column layout to a single column layout 
- Each post will be slightly indented or use connecting lines to indicate the post order
- **Back end**
    - All server-side scripting will be done in PHP 
    - Users will be authenticated for login using PHP by querying the database and checking that their password/email match a particular user in the database
    - If a user routes to page that does not exist, they are notified and then routed back to main/home page
    - PHP will be used to implement searches for particular posts/tags that the user makes.
- **Database**
    - A MySQL database will be used to store user data
    - Appropriate security measures will be implemented to protect user data 
    - User thumbnail will be stored in and loaded from database and appear on all respective user posts
    - Ability to save statistics about posts



