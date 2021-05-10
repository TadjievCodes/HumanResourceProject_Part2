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


<div style="padding-left:16px">
<div>
  <h2>List of employees:</h2>
</div>
<br />

<?php
	   

//F.	List the raw employee data from PHP. This could be done in a simple <table> for now.
	$con = getdb();
    $Sql = "SELECT * FROM employee ";
    $result = mysqli_query($con, $Sql);  
?>
		<button onclick="Display()" class="btn btn-primary">  Display Employee  </button>
		<a href="create.php" class="btn btn-success">  Create New  </a>
		<button onclick="Edit()" class="btn btn-warning">  Edit  </button>
<?php
    if (mysqli_num_rows($result) > 0) {
		?>
	<table class="table" id="Employees">
    <thead>
        <tr>
			<th></th>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Last Name</th>
          </tr>
    </thead>
    <tbody>
<?php
		     while($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
			<td><input type="checkbox" class="selectEmployee" name="selectEmployee" value="<?php echo $row['EmployeeID']; ?>"></td>
            <td><?php echo $row['EmployeeID']; ?></td>
            <td><?php echo $row['EmployeeFirstName']; ?></td>
            <td><?php echo $row['EmployeeLastName']; ?></td>
          </tr>
<?php
			 }
			 ?>
</tbody>
</table>
<?php
	}
?>

</div>



<script>
$(document).ready(function(){
    $('input:checkbox').click(function() {
        $('input:checkbox').not(this).prop('checked', false);
    });
});
function Add(){
	alert('Add');
};
function Edit(){
	var checkedEmployee = $('.selectEmployee:checked').val();
	if (checkedEmployee==null){
	alert('Error: You must select an employee!');
	}
	else{
	window.open("edit.php?id="+checkedEmployee,"_self")

	}
};
function Display(){
	var checkedEmployee = $('.selectEmployee:checked').val();
	if (checkedEmployee==null){
		alert('Error: You must select an employee!');
	}
	else{

		$.ajax({
		type: "GET",
		url: "display.php?id=" + checkedEmployee,
		success: function (data) {
			var obj = JSON.parse(data);
			alert('Display data from JSON:\n* Employee ID: '+obj.EmployeeID+'\n* First Name: '+obj.EmployeeFirstName+'\n* Last Name: '+obj.EmployeeLastName+'\n* Gender: '+obj.Gender+'\n* Initial Level: '+obj.InitialLevel);
		},
		error: function (result) {
			alert("Error!");
		}
		});
	}
};


</script>

</body>
</html>