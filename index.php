<?php

//Check if cookie is empty (Checks if the user is logged in already)
if(empty($_COOKIE['username']))
{
	//If the user is not logged in but trying to visit this page, it should bounce him back to login page
  	header('location: login.php');
}

//This demands the functions.php (remember db.php has been included there, because you would be seeing me making use of $db)
include ('functions.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $_COOKIE['username']."'s Homepage"; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
  <style>
	body
	{
		background: #000000;
		color: #fff;
	}
  </style>
	
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">

  <a class="navbar-brand" href="index.php">Simple Php Login And Registration With Cookie</a>


  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    More<span class="navbar-toggler-icon"></span>
  </button>

  
	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav">
	
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				<?php
				//This is to get current user's details
				$query = "SELECT * FROM users WHERE username = '".$_COOKIE['username']."' LIMIT 1";
				$result = mysqli_query($db, $query);


				while ($row = mysqli_fetch_array($result))
				{
					//Checks if the current user's profile_img column is empty in the database which is made empty by default while registrating
					if(empty($row['profile_img']))
					{
						//If the profile image is empty, display an image from the folder 'images' depending on the user's gender (The kimages kin that folder are 2 and were saved as Male and Female respectively)
						echo "<img class='rounded-circle user_img' style='border-radius: 35%;padding:3px; height:70px; width: 70px;' src='./images/".$row['gender'].".jpg'>";
					}
					else
					{
						//If profile image is not empty (which means that the current user has already uploaded a image from the settings page), diplay the uploaded photo which is in the database.
						echo '<img class="rounded-circle user_img" style="border-radius: 35%;padding:3px; height:70px; width: 70px;" src="data:image/jpeg;base64,'.base64_encode( $row['profile_img'] ).'"/>';
					}
				}
				
				//Diplay current user's username
				echo $_COOKIE['username'];
				?>
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="settings.php">Edit Account</a>
					 <form method="post">
						<button type="submit" name="logout_user" class="btn btn-danger form-control">Logout</button>
					</form>
				</div>
			</li>
		</ul>
	</div>
</nav>



<center>
<h4>This is the homepage, nothing is here but you can add whatever you have in mind</h4>
Anyways Check out the other features above
</center>


</body>
</html>
