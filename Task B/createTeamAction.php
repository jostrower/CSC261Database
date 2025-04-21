<?php
include 'db.php';

$studentID = $_GET['studentID'] ?? null;
$courseID = $_GET['courseID'] ?? null;
$teamName = $_GET['teamName'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}
if (!$courseID) {
    die("No team ID submitted.");
}

$teamQuery = "
SELECT ID
FROM Team";
$teamResult = $conn->query($teamQuery);

$teamIDs = [];
if($teamResult){
    while($row = $teamResult->fetch_assoc()){
        $teamIDs[] = $row['ID'];
    }
}
sort($teamIDs);
$teamID = end($teamIDs) + 1;

$insertTeam = "
INSERT 
INTO Team (ID, Name, CourseID, LeaderID)
VALUES ($teamID, '$teamName', '$courseID', $studentID)";
$insertTeamResult = $conn->query($insertTeam);

$insertMember = "
INSERT
INTO TeamMember (TeamID, StudentID)
VALUES ($teamID, $studentID)";
$insertMemberResult = $conn->query($insertMember);

header("Location: dashboard.php?studentID=$studentID");
exit;
?>
