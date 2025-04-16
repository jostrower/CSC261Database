<?php
include 'db.php';

$studentID = $_POST['studentID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}

$sql = "SELECT * FROM Student WHERE ID = $studentID";
$result = $conn->query($sql);
//echo "Result rows:" . $result->num_rows ."<br>";

if ($result->num_rows > 0) {
    header("Location: dashboard.php?studentID=$studentID");
    //echo "Student found in database. ID: $studentID";
    exit;
} else {
    header("Location: registration.html?studentID=$studentID");
    //echo "Student not found. Would redirect to registration page.";
    exit;
}
?>
