<?php
    include 'db.php';

    $ID = $_POST['ID'] ?? null;
    $name = $_POST['name'] ?? null;
    $major = $_POST['major'] ?? null;
    $year = $_POST['year'] ?? null;
    $email = $_POST['email'] ?? null;
    $departmentID = $_POST['departmentID'] ?? null;
    $type = $_POST['type'] ?? null;

    if (!$ID) {
        die("No student ID submitted.");
    }

    if($type == "student"){
        // Prepare the SQL statement for inserting data into the 'users' table
        $sql = "INSERT INTO Student (ID,Name,Major,Year,Email) VALUES ($ID, '$name', '$major', $year, '$email')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // If the insertion is successful, display a success message
            header("Location: dashboard.php?studentID=$ID");
        } else {
            // If the insertion fails, display an error message
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else if ($type == "professor"){
        // Prepare the SQL statement for inserting data into the 'users' table
        $sql = "INSERT INTO Professor (ID, Name, DepartmentID, Email) VALUES ($ID, '$name', '$departmentID', '$email')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // If the insertion is successful, display a success message
            header("Location: profDashboard.php?profID=$ID");
        } else {
            // If the insertion fails, display an error message
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else {
        die("Invalid user type submitted.");
    }
?>
