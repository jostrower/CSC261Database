<?php
include 'db.php';

$teamID = $_POST['teamID'] ?? null;
$teamName = $_POST['teamName'] ?? null;
$studentID = $_POST['studentID'] ?? null;

if (!$teamID) {
    die("No team ID submitted.");
}
if (!$teamName) {
    die("No team name submitted.");
}
if (!$studentID) {
    die("No student ID submitted.");
}


$update = 
"UPDATE Team
SET Name = '$teamName'
WHERE ID = $teamID";
$updateResult = $conn->query($update);

header("Location: team.php?teamID=$teamID&studentID=$studentID");
exit;
?>
