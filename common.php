<?php
function getdb(){
$servername = "localhost";
$username = "human_resource_user";
$password = "123456";
$db = "humanresource";
try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>