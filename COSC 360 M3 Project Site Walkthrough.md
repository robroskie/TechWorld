# COSC 360 M3 - Site Walkthrough

## Team members:
- Luke Roblesky
- Jacob Harding

## Deployed Site:
[http://cosc360.ok.ubc.ca/jake10/the-project-luke-and-jacob-cosc-360/src/server/index.php](http://cosc360.ok.ubc.ca/jake10/the-project-luke-and-jacob-cosc-360/src/server/index.php)

<hr style="border:2px solid gray"> </hr>

### User login credentials
-Normal User - **username**: Firestone1, **password**: 123</p>
-Admin - **username**: admin1, **password**: admin1</p>

<hr style="border:2px solid gray"> </hr>

-Upon first loading the website the user will be taken to the index.php page. The idea behind our website is that it is a forum where users can ask and answer questions about topics relating to technology.

## Home page (index.php)
- At the top and bottom of the document respectively there is a Bootstrap header and footer. The left side of the header contains a Home button, which takes the user back to the index.php page, and an All Topics dropdown button to filter the threads by a selected topic. If the website user is logged in, the right side of the header will display a create a thread, user avatar, user name and logout buttons. However if the user is not logged in, the right side of the header presents login and signup buttons.

- The left side of the document body contains, according to the selected search criteria, the 5 top thread titles along with a preview of each question. Threads can be searched for by typing in words or phrases contained in the thread titles and clicking the magnifying glass or hitting enter. 

https://user-images.githubusercontent.com/28748883/144934808-052db74f-5bc9-4704-95f7-a8d7e63004d7.mov

- Upon hovering over a thread, the element will turn a highlight yellow color. At most 5 threads are displayed within the element at a time, and the user can view additional threads by using the arrow buttons at the bottom of the box. Thread pages can be jumped to directly as well, by typing in the desired thread page and hitting enter. Clicking a thread will display it along with all comments on the right hand side. 

https://user-images.githubusercontent.com/28748883/144931325-d37ddf7e-7223-49d6-8a99-b3bde9a17d4d.mov

- If the user is logged in, then an option will be a textbox displayed at the bottom of the thread comments where a reply can be written and submitted. A logged in user can create new threads by clicking the Create a Thread+ button at the top of the page, and entering the topic and body.

https://user-images.githubusercontent.com/28748883/144937649-26517704-a0a0-4283-9cd9-5c4ed75605ed.mov

## Login page (login.php)
- Clicking 'Login' from the main page redirects to a login form, which can be used by both users and admin. A user or admin can easily logout by clicking the 'Logout' button at the top of the page.

## User Account page (userAccount.php)
- Clicking the username or avatar at the top right of the header, will bring you to the user account page. Here a user can view their account avatar, username, email address and the collective number of threads and comments that they have contributed to the website.

- If one wishes to change their profile picture they can do so by hovering over and clicking their current profile picture. They can also modify their username and email by clicking the 'Edit details' button and then entering the new desired username and email address. If satisified with the newly entered details, they can be confirmed by clicking 'Save Changes,' and if they wish to discard the changes and maintain their current account details they can simply hit 'Cancel.'

https://user-images.githubusercontent.com/28748883/145143439-6ed217f0-5d86-4fb5-8585-6026c644f913.mp4

## Change Password page (changePassword.php)
- Clicking the 'Change Password' button on the user account page redirects to the change password page. Here the logged in user can update their password by filling in the appropriate fields and clicking 'Submit.'

https://user-images.githubusercontent.com/28748883/145143067-1c386157-a0ee-44b8-828d-d057064b1ac4.mp4

## Admin page (admin.php) 
- On the user account page, if it is an administrator that is logged in, an additional button will appear called 'Admin Manage' and clicking this will take the admin to admin management page. 

- From here, the admin can choose to search for threads by the username of the poster, email of the poster or thread title. After entering the desired search value and hitting enter or clicking the magnifying glass, the results are displayed below. Here we see the 

- The admin can then toggle the displayed user's posting privileges on or off or click the 'Manage User Posts' to be taken to adminManageUser.php

https://user-images.githubusercontent.com/28748883/145143777-7dfe45ef-e81f-4fda-b8ec-2568ef2e95f1.mp4

## Admin Manage User page (adminManageUser.php)
- On this page we see the details at the top of the page of the user account that the admin is currently monitoring. The box just right of this allows the admin to toggle between displaying the threads and comments that the selected user has posted. For each of the threads displayed, the admin can navigate to the thread, toggle between showing and hiding the thread on the website, or delete the thread permanently.

https://user-images.githubusercontent.com/28748883/145143806-272827c6-d216-40fc-beee-b7ed11380a70.mp4



