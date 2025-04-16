<?php
include 'db.php';

$teamID = $_POST['teamID'] ?? null;
$removedID = $_POST['removedID'] ?? null;
$studentID = $_POST['studentID'] ?? null;
if (!$teamID) {
    die("No team ID submitted.");
}
if (!$studentID) {
    die("No student ID submitted.");
}
if (!$removedID) {
    die("No removed ID submitted.");
}

$delete = 
"DELETE
FROM TeamMember
WHERE StudentID = $removedID
AND TeamID = $teamID";
$deleteResult = $conn->query($delete);

header("Location: team.php?teamID=$teamID&studentID=$studentID");
exit;
?>
