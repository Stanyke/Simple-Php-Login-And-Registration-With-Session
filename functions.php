<?php
//This demands the db.php (where the database setup is located)
require_once ('./db.php');


//This gives room for error in an array, if there are any
$errors = array();


//If the name data type 'name' with value 'register_user' is submitted from the signup.php page
if (isset($_POST['register_user']))
{
	$your_fname = mysqli_real_escape_string($db, $_POST['fname']); //Get data type 'name' with value 'fname' and give it a variabe name
	
	$your_lname = mysqli_real_escape_string($db, $_POST['lname']);
	
	$your_username = mysqli_real_escape_string($db, $_POST['username']);
	
	$your_password = mysqli_real_escape_string($db, $_POST['password']);
	
	$your_gender = mysqli_real_escape_string($db, $_POST['gender']);
	
	$your_country = mysqli_real_escape_string($db, $_POST['country']);
	
	$your_state = mysqli_real_escape_string($db, $_POST['state']);
	
	
	//Check if any of the gotten inputs (variables) is empty, which would be throwing an error if there is any error through the help of the errors.php file and its array variabe defined above
	if (empty($your_fname))
	{ 
		array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Firstname Is Required</div>');
	}
	
	elseif (empty($your_lname))
	{ 
		array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Lastname Is Required</div>');
	}
	
	elseif (empty($your_username))
	{ 
		array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username Is Required</div>');
	}
	
	elseif (empty($your_password))
	{ 
		array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password Is Required</div>');
	}
	
	elseif (empty($your_gender))
	{ 
		array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Gender Is Empty</div>');
	}
	
	elseif (empty($your_country))
	{ 
		array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Country Is Empty</div>');
	}
	
	elseif (empty($your_state))
	{ 
		array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>State Is Empty</div>');
	}

	
	//Checks if all errors that could have occured is empty
	if (count($errors) === 0)
    {
		//Run SQL query to know if the inputted username is already in the databse, 1 at least... (Basically checks if username is registered already)
		$query = $db->query("SELECT * FROM users WHERE username = '$your_username' LIMIT 1");//$db was gotten from db.php which was required earlier

		$deliveredResult = mysqli_fetch_assoc($query);
	  
		//This is to confirm it exist
		if($deliveredResult)
		{
			//More confimation that the inputted username matches the one gotten from the database
			if ($deliveredResult['username'] === $your_username)
			{
				//If the it's really true, it should throw a bootstrap alert with a couple of text
				array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Username Already Exist</div>');
			}
		}
		//This is to proceed with registration since the inputted username could not be found in the database (this is just to make usernames unique)
		else
		{
			//Now, lets encrypt our password and give it a variabe 'hash'
			$hash = password_hash($your_password, PASSWORD_DEFAULT);
			
			$currentTimeAndDate = date("l, d-m-Y, h:i:s a");
			
			//Finally, lets save our inputted data to the database since the username is currently unique to the database. Also i'll be leaving the value for profile_img empty
			$query = $db->query("INSERT INTO users (fname, lname, username, password, gender, country, state, profile_img, reg_time)VALUES('$your_fname', '$your_lname', '$your_username', '$hash', '$your_gender', '$your_country', '$your_state', '', '$currentTimeAndDate')");
			
			
			//If the saving/registration was successful, store the username in the session
			if($query)
			{
				$_SESSION['username'] = $your_username;
			
				header('location: index.php');
			}
			
			//If the saving/registration was unsuccessful, process the data below
			else
			{
				array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> There Was A System Error, We Are Already Working On It, Try Again...</div>');
			}
		}
	}
}







//This is for the login Section below




//If the name data type 'name' with value 'login_user' is submitted from the login.php page
if (isset($_POST['login_user']))
{
	$your_username = mysqli_real_escape_string($db, $_POST['username']); //Get data type 'name' with value 'username' and give it a variabe name
	$your_password = mysqli_real_escape_string($db, $_POST['password']);

	//Run SQL query to know if the inputted username is already in the databse, 1 at least... (Basically checks if username is registered already)
	$query = $db->query("SELECT * FROM users WHERE username = '$your_username' LIMIT 1");
	
	$deliveredResult = mysqli_fetch_assoc($query);
	
	//This is to confirm it exist
	if($deliveredResult)
	{
		//More confimation that the inputted username matches the one gotten from the database
		if ($deliveredResult['username'] === $your_username)
		{
			//This gets the user's password from the database
			$gottenPassword = $deliveredResult['password'];
			
			//This checks if the password gotten matches the decryption process is true
			if(password_verify($your_password, $gottenPassword))
			{
				//This logs in the user and gives a session a variable
				$_SESSION['username'] = $your_username;
			
				//Directs the user to index.php
				header('location: index.php');
			}
			//This checks if the password gotten matches the decryption process is not true
			else
			{
				//Pops up an error message
				array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username And Password Does Not Match</div>');
			}
		}
	}
	//This is to show that the username inputted is not even registered and cant be found in the database as a registered username
	else
	{
		//Pops up an error message
		array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> Username Not Registered With Us</div>');
	}
}









//This is updating Profile Picture



//If the name data type 'name' with value 'update_user' is submitted from the settings.php page
if (isset($_POST['update_user']))
{
	$your_photo = $_FILES['image']['name']; //Get data type 'name' with value 'image' and give it a variabe name
	
	//Checks if truely any file was inserted (if it is not empty)
	if(!empty($your_photo))
	{
		$img_tmp_name = $_FILES['image']['tmp_name']; //Gets file to temporal memory location
		
		$image_size = $_FILES['image']['size']; // Gets files size

		//Checks if the file type/extension is either jpg, jpeg or png
		if($_FILES["image"]["type"] == "image/jpg" || $_FILES["image"]["type"] == "image/jpeg" || $_FILES["image"]["type"] == "image/png")
		{
			//Checks is file size is greater than zero (This helps to identify a broken image file, since it has confirmed above that file is already an image file, so we dont upload corrupt image file).
			if($image_size > 0)
			{
				//Adds image file to temporal memory location
				$imgContent = addslashes(file_get_contents($img_tmp_name));
				
				//Update users profile image with column name 'profile_img' in the databa with the temporal image file
				$query = $db->query("UPDATE users SET profile_img='$imgContent' WHERE username = '".$_SESSION['username']."' LIMIT 1");
				
				//pops up a notification to user
				array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Profile Image Updated</div>');
			}
			//Confirms that image file is corrupt
			else
			{
				//Pops up error notice (Note: this is rare to come by, we are just taking all security measures)
				array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> File selected does not contain a valid image</div>');
			}
		}
		//Confirms that file is not among the image type needed (something like .gif files would be declined)
		else
		{
			//Pop up error notice
			array_push($errors, '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Oops!</strong> File selected is not allowed</div>');
		}
	}
}







//This is help user log out



//If the name data type 'name' with value 'logout_reg' is submitted from the index.php & settings.php pages
if (isset($_POST['logout_reg']))
{
	session_destroy(); //Closes Current User's Session
  	unset($_SESSION['username']); //Remove the username addedd to the session
  	header("location: login.php"); //Directs the user back to login page.
}
?>