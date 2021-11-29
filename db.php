<?php

function db_connect () {
	
	//Define connection as a static variable, to avoid connecting more than once.
	
	
	static $connection;
	
	// Try and connect to the database, if a connection has not been established yet
	
	
if(!isset($connection)) {
$host = "localhost";
$username = "root";
$password = "";
$dbname = "phones";


$connection = mysqli_connect($host, $username, $password, $dbname);
}


// if connection was not successful handle the error


if ($connection === false) {
	
	// handle error
	
	return mysqli_connect_error();
}

return $connection;

}

function db_query($query) {

$connection = db_connect ();

$result = mysqli_query ($connection,$query);

return $result;

}

$result = db_query("SELECT * from mobile_phones");


if($result === false) {
	
	// Handle failure
	
	die ("Query error!");
	
} else {
	
	// Fetch all the rows in an array 
	
	$rows = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$rows [] = $row;
		
	}
	
}

//* Functia de selectare *///

function db_select ($query) {
	
	$rows = array();
	$result = db_query($query);
	
	//* if query failed, return false
	
	if($result === false) {
		return false;
	}
	
	//* if query was successful, retrieve all the rows into an array
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
	
}

///************************************ interogare 

$rows = db_select("Select * From mobile_phones");
if($rows === false) {
	
	// Handle error
	
	die("Error.");
	
} else {
	
	foreach ($rows as $row) {
		foreach ($row as $key => $value) {
			echo ucfirst ($key) . ": ". $value . "<br>";
		}
		echo "................................<br>";
	}
}

/*****************************delete *//////////////

$rows = $_REQUEST['id'];
$query ="DELETE from mobile_phones where id=&id";
$result = mysqli_query($con,$query) or die (mysqli_error());
header("Location:view.php");


?>