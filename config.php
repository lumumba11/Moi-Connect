<?php
// Database credentials (replace with your actual credentials)
$servername = "localhost:3307";
$username = 'root';
$password = '';
$dbname = 'moiconnect';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// Close connection (to be done at the end of your script)
?>
