# Simple-Php-Login-And-Registration-With-Session

This is a simple php login and registration system with the support of MySQL as database which can be used on Xampp or Wamp.

**Basic Things About This Web App**

1. There's a file named php_with_session.sql, this file helps setup your database and table as to how i created it perfectly, to use the file goto your xampp or wamp sever and create a database called 'php_with_session', as soon as it demands for the table name. Click on import and select file, then upload this file, finally click on GO button at the bottom of the page. 


2. The code has been commented in such a way that a newbie could understand what happens within the app, enhancing one's self.


3. This app was built with session, this means that the logged in user's information is stored until He/She closes the browser (not browser's tab), but in this app i stored the user's username which i made to be unique while registering. The session helps retrieve some information about the current logged in user in the browser from the database through the username saved with the session.

Example Below...

<?php echo $_SESSION['username']; ?>

The code above displays the users username, so you can now see we can now make any request from the database the username stored.

4. The app has a login, signup, index, settings page displayed in the frontend, including other php files like db.php, functions.php, errors.php which helps this web application.

Below are the details of what each file does...

- **index.php:** This is always the landing page for every website but the user can't access this page unless He/She is logged in. Here is an awesome feature i added to this page --- Even thou the user trys visiting this page, the page first of all checks if the session is empty (to know if there's any username within the session) and if the session is empty, it automatically bounces the user back to login.php page without loading the whole of index.php.

- **login.php:** This is where the user has to login, well thats if He/She has registered already. Here is an awesome feature i added to this page --- Even thou the user trys visiting this page, the page first of all checks if the session is not empty (to make sure there's no username within the session) and if the session is truely not empty, it automatically bounces the user back to index.php page without loading the whole of login.php.

- **signup.php:** This is where the user has to register, also while registering the user it checks if the user's inputted username is currently available in the database and if it's true, it declines the registration. Here is an awesome feature i added to this page --- Even thou the user trys visiting this page, the page first of all checks if the session is not empty (to make sure there's no username within the session) and if the session is truely not empty, it automatically bounces the user back to index.php page without loading the whole of signup.php.

- **settings.php:** This is where the logged in user has to update just the profile image, since the user registered the profile is empty and currently adapting pre added images (Male & Female, located inside folder 'images'). Here is an awesome feature i added to this page --- Even thou the user trys visiting this page, the page first of all checks if the session is empty (to know if there's any username within the session) and if the session is empty, it automatically bounces the user back to login.php page without loading the whole of settings.php.

**OTHER FILES SEEN IN THIS PROJECT**

- **db.php:** This is where i made the database connection.

- **functions.php:** This is where most of the website's function/logic is (registration, login, updating account & logout).

- **scripts.js:** This is where the website javascript used is located (this file was mostly used on login and signup page).

- **errors.php:** This helps to scale error or notifications.

- **FOLDER images:** This is where Male & Female image icon is located, these images help display new user's image before He/She could update it, depending on gender the user registered with.