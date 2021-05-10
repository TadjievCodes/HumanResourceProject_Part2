<?php
/*
   Purpose: D.	Import the uploaded employee data into a MySQL database
			E.	Produce a message for any duplicate employee names in the upload file. (It could happen.)
   Date: Feb 2021
   */
$active="import";
require("common.php");
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


<div style="padding-left:16px">
<div>
<?php
 if(isset($_POST["Import"])){
    
    $filename=$_FILES["file"]["tmp_name"];    
     if($_FILES["file"]["size"] > 0)
     {
		 $file = fopen($filename, "r");
		 $i =0;
		$j=0;
		$con = getdb();
		$getData = fgetcsv($file, 10000, ",");
		
		//Note: a CSV upload should delete any existing employee data in the table.
		$sql = "DELETE FROM employee WHERE 1=1";
		$result = mysqli_query($con, $sql);
		
	  while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	   {
		   $con = getdb();
		   $j++;
		   
		   
		   
    $Sql_dup = "SELECT * FROM employee where EmployeeFirstName='".$getData[1]."' and EmployeeLastName='".$getData[2]."'";
    $verif_dup = mysqli_query($con, $Sql_dup);  

    if (mysqli_num_rows($verif_dup) > 0) {
		
		//E.	Produce a message for any duplicate employee names in the upload file. (It could happen.)
		echo "<p style='color:red'>Error: Duplicated employee name (".$getData[1].' '.$getData[2].')</p>';   
	}
	else{
		 $sql = "INSERT into employee (EmployeeID,EmployeeFirstName,EmployeeLastName) 
			   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."')";
		$result = mysqli_query($con, $sql);
	if(!isset($result))
	{
	  echo "<p style='color:red'>Error: line ".$j.'</p>';    
	}
	else {
		$i++;		
	}
	   }}
	   
	   echo ("<br><h2 style='color:green'>".$i." lines has been successfully Imported. </h2><br>");
  
	   fclose($file); 
 }
 else{
	 echo "<p style='color:red'>Error.</p>";   
 }
 }
 else{
?>

<form class="form-horizontal" method="post" name="importcsv" enctype="multipart/form-data">
	<fieldset>
		<!-- Form Name -->
		<legend>Import CSV</legend>
		<!-- File Button -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="filebutton">Select File</label>
			<div class="col-md-4">
				<input type="file" name="file" id="file" class="input-large">
			</div>
		</div>
		<!-- Button -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="singlebutton">Import data</label>
			<div class="col-md-4">
				<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
			</div>
		</div>
	</fieldset>
</form>

<?php
}
?>
</div>
</body>
</html>