<?php
    include 'db.php';

    $studentID = $_POST['studentID'] ?? null;
    $name = $_POST['name'] ?? null;
    $major = $_POST['major'] ?? null;
    $year = $_POST['year'] ?? null;
    $email = $_POST['email'] ?? null;

    if (!$studentID) {
        die("No student ID submitted.");
    }
    if (!$name) {
        die("No name submitted.");
    }

	// Prepare the SQL statement for inserting data into the 'users' table
	$sql = "INSERT INTO Student (ID,name,major,year,email) VALUES ($studentID, '$name', '$major', $year, '$email')";

	// Execute the query
	if ($conn->query($sql) === TRUE) {
		// If the insertion is successful, display a success message
		echo "New record created successfully!";
	} else {
		// If the insertion fails, display an error message
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>
