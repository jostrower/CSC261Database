<?php
include 'db.php';

$studentID = $_GET['studentID'] ?? null;
$courseID = $_GET['courseID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}
if (!$courseID) {
    die("No course ID submitted.");
}


$insert = 
"INSERT 
INTO Enrollment (StudentID, CourseID)
VALUES ($studentID, '$courseID')";
$insertResult = $conn->query($insert);

header("Location: dashboard.php?studentID=$studentID");
exit;
?>
