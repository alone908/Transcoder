<?php

$servername = "localhost";
$username = "root";
$password = "A123456b";
$dbname = "Transcoder";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else {
//echo "Connected successfully";
}
