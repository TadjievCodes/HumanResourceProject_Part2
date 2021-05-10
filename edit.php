<?php
/* 
   Purpose: F.	List the raw employee data from PHP. This could be done in a simple <table> for now.
   Date: Feb 2021
*/
   
require("common.php");
$active="list";
// Init session
session_start();
// Check if the user is logged in, otherwise redirect them to the login page
if(!isset($_SESSION["username"])){
	header("Location: login.php");
	exit(); 
}
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

<?php

if (isset($_REQUEST['EmployeeFirstName'], $_REQUEST['EmployeeLastName'], $_REQUEST['Gender'], $_REQUEST['InitialLevel'])){
	$conn = getdb();
	$id=$_GET['id'];
	// retrieve data from the form
	$EmployeeFirstName = stripslashes($_REQUEST['EmployeeFirstName']);
	$EmployeeFirstName = mysqli_real_escape_string($conn, $EmployeeFirstName); 
	$EmployeeLastName = stripslashes($_REQUEST['EmployeeLastName']);
	$EmployeeLastName = mysqli_real_escape_string($conn, $EmployeeLastName);
	$Gender = stripslashes($_REQUEST['Gender']);
	$Gender = mysqli_real_escape_string($conn, $Gender);	
	$InitialLevel = stripslashes($_REQUEST['InitialLevel']);
	
	
	//SQL request
    $query = "UPDATE `employee` SET EmployeeFirstName='$EmployeeFirstName', EmployeeLastName='$EmployeeLastName', Gender='$Gender',InitialLevel='$InitialLevel'
              Where EmployeeID='$id'";
	//echo ($query );
	// Run the query on the database
    $res = mysqli_query($conn, $query);
    if($res){
       header("Location: listemployees.php");
    }
	else{
		echo 'Error!';
	}
}else{
	
$id=$_GET['id'];
$conn = getdb();
$query = "SELECT * FROM `employee` WHERE EmployeeID='$id'";
$result = mysqli_query($conn,$query) or die(mysql_error());
$employee = mysqli_fetch_assoc($result);
?>
<form action="" method="post">
	<div class="col-md-3">
		<h1 class="box-title">Edit Employee:</h1>
		
		<div class="form-group">
		<input type="text" class="form-control" name="EmployeeID" value='<?php echo $employee['EmployeeID']; ?>' disabled />
		</div>
		<div class="form-group">
		<input type="text" class="form-control" name="EmployeeFirstName" value="<?php echo $employee['EmployeeFirstName']; ?>" required />
		</div>
		<div class="form-group">
		<input type="text" class="form-control" name="EmployeeLastName" value="<?php echo $employee['EmployeeLastName']; ?>" required />
		</div>
		<div class="form-group">
		<select name="Gender" id="Gender" class="form-control" required >
			<option value="">--Please choose an option--</option>
			<option value="M" <?php if($employee['Gender']=='M'){echo 'selected';} ?>>Male</option>
			<option value="F" <?php if($employee['Gender']=='F'){echo 'selected';} ?>>Female</option>
		</select>
		</div>
		<div class="form-group">
		<input type="number" class="form-control" name="InitialLevel" value="<?php echo $employee['InitialLevel']; ?>" min="1" max="99" required />
		</div>
		<div class="form-group">
		<input type="submit" name="submit" value="Edit" class="btn btn-success" />
		</div>	
	</div>
</form>
<?php } ?>



</body>
</html>