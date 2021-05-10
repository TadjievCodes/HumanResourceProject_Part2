<?php
/* 
   Purpose: Part 1
   Date: Feb 2021
   */
//Redirect to HTTPS
if (empty($_SERVER['HTTPS'])) {
    header('Location: https://localhost/humanresource/index.php');
    die();
}
// Init session
session_start();
// Check if the user is logged in, otherwise redirect them to the login page
if(!isset($_SESSION["username"])){
	header("Location: login.php");
	exit(); 
}
$active="index";
?>
<html lang="en">
<head>
  <title>Human Resource Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<?php
require("navbar.php");
?>

<div style="padding-left:16px">
<div>
  <h2>INFO5094 LAMP 2 Group Project</h2>
  <p>Part 1 & Part 2<br />Date: March 2021</p>  
  <h1>Group 10:</h1>
  <ul>
	  <li>Khashayar Norouzi</li>
	  <li>Molly Viau</li>
	  <li>Serhii Vilkun</li>
	  <li>Adil Islambekov</li>
	  <li>Mukhammadkhon Tadjiev</li>
	  <li>Wander Cepeda</li>
  </ul>
</div>
<br /><br />
	<div class="form-group col-md-12">
		<a href="generatecsv.php" class="btn btn-primary">Generate random CSV file</a>
	</div>
	<div class="form-group col-md-12">
		<a href="importcsv.php" class="btn btn-success">Import CSV file</a>
	</div>
	<div class="form-group col-md-12">
		<a href="listemployees.php" class="btn btn-warning">List Employees from Database</a>
	</div>
</div>
</body>
</html>