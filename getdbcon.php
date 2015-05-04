<?php 
    $host="localhost"; 
	$username="root";  
	$password="";      
	$db_name="EGovtools";

function getConnection()
{
	$host="localhost"; 
	$username="root";  
	$password="";      
	$db_name="EGovtools";  
	
	$connection=mysqli_connect($host, $username, $password, $db_name)or die("Cannot connect the database. Please contact site admin."); 
	return $connection;
}
?>