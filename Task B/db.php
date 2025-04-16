<?php
	// Set database connection parameters
	$servername = "localhost"; // Database host
	$username = "jostrowe";      // Database username (default for local MySQL server)
	$password = "DAh8jEgS";    // Database password (leave empty if there's no password)
	$dbname = "jostrowe_1";      // Database name to connect to

	// Create a connection using mysqli
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check if the connection is successful
	if ($conn->connect_error) {
		// If there is a connection error, display the error message and exit
		die("Connection failed: " . $conn->connect_error);
	}
	//else {
	//	echo "Connected successfully to the database!";
	//}
?>