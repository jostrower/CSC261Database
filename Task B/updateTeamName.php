<?php
include 'db.php';

$teamID = $_POST['teamID'] ?? null;
$teamName = $_POST['teamName'] ?? null;
$ID = $_POST['ID'] ?? null;
$type = $_POST['type'] ?? null;
$courseID = $_POST['courseID'] ?? null;

if (!$teamID) {
    die("No team ID submitted.");
}
if (!$teamName) {
    die("No team name submitted.");
}
if (!$ID) {
    die("No ID submitted.");
}
if (!$type) {
    die("No type submitted.");
}
if (!$courseID) {
    die("No course ID submitted.");
}


$update = 
"UPDATE Team
SET Name = '$teamName'
WHERE ID = $teamID";
$updateResult = $conn->query($update);

header("Location: team.php?teamID=$teamID&ID=$ID&type=$type&courseID=$courseID");
exit;
?>
