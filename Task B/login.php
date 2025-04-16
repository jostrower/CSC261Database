<?php
include 'db.php';

$studentID = $_POST['studentID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}

$sql = "SELECT * FROM Student WHERE ID = $studentID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //header("Location: dashboard.php?studentID=$studentID");
    echo "Student found in database. ID: $studentID";
    exit;
} else {
    //header("Location: register.php?studentID=$studentID");
    echo "Student not found. Would redirect to registration page.";
    exit;
}
?>
