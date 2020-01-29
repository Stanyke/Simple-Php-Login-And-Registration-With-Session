<?php

//Check if session is empty (Checks if the user is logged in already)
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
  <title><?php echo $_COOKIE['username']."'s Account Setting"?></title>
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
	
	label
	{
		float: left;
		color: #000;
		font-size: 20px;
	}
	
	note
	{
		color: red;
	}
	
	p
	{
		color: orange;
		float: left;
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
					 <form method="post">
						<button type="submit" name="logout_user" class="btn btn-danger form-control">Logout</button>
					</form>
				</div>
			</li>
		</ul>
	</div>
</nav>


<div class="jumbotron text-center">

<note><h3>Note Only Profile Picture Can Be Updated</h3></note>

<?php 

//Include the error.php (This is where the error would always popout at)
include('./errors.php'); 

?>

<div class="container-fluid">

<?php

$sql = "SELECT * FROM users WHERE username = '".$_COOKIE['username']."' LIMIT 1";
$result = mysqli_query($db, $sql);


while ($row = mysqli_fetch_array($result))
{


?>
<form method="post" enctype="multipart/form-data">
	<div class="col-sm-6 my-1">
		<label>USERNAME:</label>
		<input class="form-control" type="text" name="email" value="<?php echo $_COOKIE['username'] ?>" readonly>
	</div>
	
	<div class="col-sm-6 my-1">
		<label>NAME:</label>
		<input class="form-control" type="text" name="full_name" value="<?php echo $row['fname']." ".$row['lname']?>" readonly>
	</div>
	
	<div class="col-sm-6 my-1">
		<label>GENDER:</label>
		<input class="form-control" type="text" name="gender" value="<?php echo $row['gender']?>" readonly>
	</div>
	
	<div class="col-sm-6 my-1">
		<label>COUNTRY:</label>
		<input class="form-control" type="text" name="country" value="<?php echo $row['country']?>" readonly>
	</div>
	
	<div class="col-sm-6 my-1">
		<label>STATE:</label>
		<input class="form-control" type="text" name="state" value="<?php echo $row['state']?>" readonly>
	</div>
	
	<div class="col-sm-6 my-1">
		<label>PROFILE PICTURE:</label>
		<p>* Leave empty if not ready to change Profile Picture, else select an image file to set as profile picture</p>
		<p>* Allowed Contents are .jpg, .jpeg, .png</p>
		<input class="form-control" type="file" name="image">
	</div>
	
	<br/>
	<div class="col-sm-6 my-1">
		<button class="btn btn-success form-control" type="submit" name="update_user">Update</button>
	</div>
	

</form>

<?php
}
?>
</div>


</body>
</html>
