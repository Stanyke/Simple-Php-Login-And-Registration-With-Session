<?php

//This we help stabilize/control session
session_start();

//Check if session is empty (Checks if the user is logged in already)
if(!empty($_SESSION['username']))
{
	//If the user is not logged in but trying to visit this page, it should bounce him back to login page
  	header('location: index.php');
}

//This demands the functions.php
include ('functions.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>SignUp</title>
	
	<style>
	body
	{
		background: #000000;
		color: #fff;
	}
	#title
	{
		font-family: times-new-roman;
	}
	.main h2
	{
		margin-bottom: 20px;
	}
	
	@media screen and (max-width: 720px)
	{
		.main
		{
			margin-top: 50px;
		}
		#title
		{
			font-size: 25px;
			text-decoration: underline;
		}
	}
	</style>
</head>
<body>
	
	<h3 id="title">Simple Php Login And Registration With Session</h3>

	<div class="container-fluid">
		<div class="main">
		
		
			<h2 align="center">Register</h2>
			
			
			<?php 
			//Include the error.php (This is where the error would always popout at)
			include('./errors.php');
			?>
			
			<form method="POST">
				<div class="form-row align-items-center">
				
					<div class="col-sm-6 my-1">
					  <input type="text" class="form-control" name="fname" placeholder="FirstName" required>
					</div>
					
					<div class="col-sm-6 my-1">
					  <input type="text" class="form-control" name="lname" placeholder="LastName" required>
					</div>
					
					<div class="col-sm-12 my-1">
					  <input type="text" class="form-control" name="username" placeholder="Username" required>
					</div>
					
					<div class="col-sm-6 my-1">
						<div class="input-group">
						<input type="password" id="password" class="form-control" name="password" placeholder="********" required>
						<div class="input-group-prepend">
						  <div class="input-group-text"><i class="fa fa-eye-slash" id="pass_status" onClick="viewPasswords()"></i></div>
						</div>
					  </div>
					</div>
					
					
					<div class="col-sm-6 my-1">
						<select name="gender" class="form-control">
							<option value="">Select Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					
					<div class="col-sm-12 my-1">
						<select id="country" type="text" class="form-control"style="margin-right:5px;"  name="country" list="country" placeholder="Country" required></select>
					</div>
					
					<div class="col-sm-12 my-1">
						<select name="state" id="state" class="form-control" required></select>
					</div>
					
					<div class="col-sm-8 my-1">
						<button type="submit" name="register_user" class="btn btn-primary form-control">Register</button>
					</div>
					<div class="col-sm-4 my-1">
						<button type="button" onClick="login_user()" class="btn btn-danger form-control">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
  
    <script defer src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script defer src="./scripts.js"></script>
	
  </body>
</html>