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

$checkQuery = "
SELECT COUNT(*) AS count 
FROM TeamMember 
WHERE TeamID = $teamID";
$checkResult = $conn->query($checkQuery);
$countRow = $checkResult->fetch_assoc();

$teamDeleted = false;

if ($countRow['count'] == 0) {
    $deleteTeam = "
    DELETE 
    FROM Team 
    WHERE ID = $teamID";
    $conn->query($deleteTeam);
    $teamDeleted = true;
}

$location = "dashboard.php?studentID=$studentID";
if ($teamDeleted) {
    $location .= "&deletedTeam=true";
}
header("Location: $location");
exit;
?>