<?php
//Redirect to HTTPS
if (empty($_SERVER['HTTPS'])) {
    header('Location: https://localhost/humanresource/login.php');
    die();
}
?>
<html>
<head>
  <title>Login Human Resource Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require("common.php");
session_start();

if (isset($_POST['username'])){
	$conn = getdb();
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
	$result = mysqli_query($conn,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	if($rows==1){
	    $_SESSION['username'] = $username;
	    header("Location: index.php");
	}else{
		$message = "User Name or Password is incorrect.";
	}
}
?>
<form class="box" action="" method="post" name="login">
<div class="col-md-6">
<h1 class="box-logo box-title"><a href="#">INFO5094 LAMP 2 Group Project</a></h1>
<h1 class="box-title">Log In</h1>

<div class="form-group">
	<input type="text" class="form-control" name="username" placeholder="User Name">
</div>
<div class="form-group">
	<input type="password" class="form-control" name="password" placeholder="Password">
</div>
<div class="form-group">
	<input type="submit" value="Log In" name="submit" class="btn btn-primary">
</div>
<p class="box-register">Create New Account? <a href="register.php">Register</a></p>
<?php if (! empty($message)) { ?>
    <p class="text-danger"><?php echo $message; ?></p>
<?php } ?>
</div>
</form>
</body>
</html>