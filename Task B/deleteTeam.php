<?php
include 'db.php';

$teamID = $_POST ["teamID"] ?? null;
$profID = $_POST ["profID"] ?? null;
$courseID = $_POST ["courseID"] ?? null;
$type = $_POST ["type"] ?? null;

if (!$teamID) {
    die("No team ID submitted.");
}
if (!$courseID) {
    die("No course ID submitted.");
}
if (!$type) {
    die("No type submitted.");
}
if (!$profID) {
    die("No ID submitted.");
}

$teamMemberDelete = "DELETE FROM TeamMember WHERE TeamID = $teamID";
$teamMemberDeleteResult = $conn->query($teamMemberDelete);

$teamDelete = "DELETE FROM Team WHERE ID = $teamID";
$teamDeleteResult = $conn->query($teamDelete);

header("Location: viewTeams.php?ID=$profID&courseID=$courseID&type=$type");
?>