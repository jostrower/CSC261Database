<?php
include 'db.php';

$studentID = $_POST['studentID'] ?? null;
$courseID = $_POST['courseID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}
if (!$courseID) {
    die("No team ID submitted.");
}


$delete = 
"DELETE 
FROM Enrollment 
WHERE StudentID = $studentID 
AND CourseID = '$courseID'";
$deleteResult = $conn->query($delete);

header("Location: dashboard.php?studentID=$studentID");
exit;
?>
