<?php
include 'db.php';

$teamID = $_POST['teamID'] ?? null;
$removedID = $_POST['removedID'] ?? null;
$ID = $_POST['ID'] ?? null;
$type = $_POST['type'] ?? null;
$courseID = $_POST['courseID'] ?? null;

if (!$teamID) {
    die("No team ID submitted.");
}
if (!$ID) {
    die("No ID submitted.");
}
if (!$removedID) {
    die("No removed ID submitted.");
}
if (!$type) {
    die("No type submitted.");
}
if (!$courseID) {
    die("No course ID submitted.");
}

$delete = 
"DELETE
FROM TeamMember
WHERE StudentID = $removedID
AND TeamID = $teamID";
$deleteResult = $conn->query($delete);

$countQuery = "SELECT COUNT(*) AS count FROM TeamMember WHERE TeamID = $teamID";
$countResult = $conn->query($countQuery);
$countRow = $countResult ->fetch_assoc();

$teamDeleted = false;
if ($countRow['count'] == 0) {
    $deleteTeam = "DELETE FROM Team WHERE ID = $teamID";
    $conn->query($deleteTeam);
    $teamDeleted = true;
}

if($teamDeleted) {
    header("Location: viewTeams.php?ID=$ID&courseID=$courseID&type=$type&deletedTeam=true");
    exit;
}

header("Location: team.php?teamID=$teamID&ID=$ID&type=$type&courseID=$courseID");
exit;
?>
