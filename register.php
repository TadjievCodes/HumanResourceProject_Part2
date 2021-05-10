<!DOCTYPE html>
<html>
<head>
  <title>Register Human Resource Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require("common.php");
if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
	$conn = getdb();
	// retrieve the username from the form
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username); 
	// retrieve the email from the form
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email);
	// retrieve password from the form
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
	//SQL request + encrypted password
    $query = "INSERT into `users` (username, email, password)
              VALUES ('$username', '$email', '".hash('sha256', $password)."')";
	// Run the query on the database
    $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='text-success'>
             <h3>You have successfully registered.</h3>
             <p>Click here to <a href='login.php'>Log In</a></p>
			 </div>";
    }
}else{
?>
<form class="box" action="" method="post">
	<div class="col-md-6">
		<h1 class="box-logo box-title"><a href="#">INFO5094 LAMP 2 Group Project</a></h1>
		<h1 class="box-title">Register</h1>
	
		<div class="form-group">
		<input type="text" class="form-control" name="username" placeholder="User Name" required />
		</div>
		<div class="form-group">
		<input type="text" class="form-control" name="email" placeholder="Email" required />
		</div>
		<div class="form-group">
		<input type="password" class="form-control" name="password" placeholder="Password" required />
		</div>
		<div class="form-group">
		<input type="submit" name="submit" value="Register" class="btn btn-success" />
		</div>	
		<p class="box-register">Already registered? <a href="login.php">Log in here</a></p>
	</div>
</form>
<?php } ?>
</body>
</html>