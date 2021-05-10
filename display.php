<?php
require("common.php");

$id=$_GET['id'];
$conn = getdb();
$query = "SELECT * FROM `employee` WHERE EmployeeID='$id'";
$result = mysqli_query($conn,$query) or die(mysql_error());
$rows = mysqli_fetch_assoc($result);
echo (json_encode($rows));

?>