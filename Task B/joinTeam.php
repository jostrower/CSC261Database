<?php
include 'db.php';

$studentID = $_POST['studentID'] ?? null;
$courseID = $_POST['courseID'] ?? null;
$teamID = $_POST['teamID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}
if (!$teamID) {
    die("No team ID submitted.");
}
if (!$courseID) {
    die("No course ID submitted.");
}

$insert = 
"INSERT 
INTO TeamMember (StudentID, TeamID)
VALUES ($studentID, $teamID)
";
$insertResult = $conn->query($insert);

header("Location: viewTeams.php?studentID=$studentID&courseID=$courseID");
exit;
?>