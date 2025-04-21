<?php
include 'db.php';

$profID = $_GET['profID'] ?? null;
$courseID = $_GET['courseID'] ?? null;

if (!$profID) {
    die("No teacher ID submitted.");
}
if (!$courseID) {
    die("No course ID submitted.");
}

$teamQuery = "SELECT * FROM Team WHERE CourseID = '$courseID'";
$teamResult = $conn->query($teamQuery);

while( $team = $teamResult->fetch_assoc() ) {
    $teamID = $team["ID"];
    $teamMemberDelete = "DELETE FROM TeamMember WHERE TeamID = $teamID";
    $teamMemberDeleteResult = $conn->query(query: $teamMemberDelete);

    $teamDelete = "DELETE FROM Team WHERE ID = $teamID";
    $teamDeleteResult = $conn->query($teamDelete);
}

$enrollmentQuery = "DELETE FROM Enrollment WHERE CourseID = '$courseID'";
$enrollmentResult = $conn->query($enrollmentQuery);

$courseQuery = "DELETE FROM Course WHERE ID = '$courseID'";
$courseResult = $conn->query($courseQuery);

header("Location: profDashboard.php?profID=$profID");
?>