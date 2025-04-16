<?php
include 'db.php';

$studentID = $_POST['studentID'] ?? null;
$teamID = $_POST['teamID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}
if (!$teamID) {
    die("No team ID submitted.");
}


$delete = 
"DELETE 
FROM TeamMember 
WHERE StudentID = $studentID 
AND teamID = $teamID";
$deleteResult = $conn->query($delete);

header("Location: dashboard.php?studentID=$studentID");
exit;
?>