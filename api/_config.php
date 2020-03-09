<?php
$baseurl= $_SERVER['REQUEST_URI'];
$baset=explode("/", $baseurl);
$baseuri=$baset[1];
$wwwbase=$baseuri;
$host="localhost";
$user="root";
$password="";
$database="geoip";
// Create connection
$conn = @new mysqli($servername, $user, $password, $database);
// Check connection
//if ($conn->connect_error) {     die("Connection failed: " . $conn->connect_error);} 
?>

