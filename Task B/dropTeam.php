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

$leaderQuery = "SELECT LeaderID FROM Team WHERE ID = $teamID";
$leaderResult = $conn->query($leaderQuery);
$leaderRow = $leaderResult->fetch_assoc();
$isLeader = ($leaderRow['LeaderID'] == $studentID);

$delete = "
DELETE 
FROM TeamMember 
WHERE StudentID = $studentID 
AND TeamID = $teamID";
$conn->query($delete);

$checkQuery = "
SELECT StudentID 
FROM TeamMember 
WHERE TeamID = $teamID";
$checkResult = $conn->query($checkQuery);
$remainingMembers = [];

if ($checkResult && $checkResult->num_rows > 0) {
    while ($row = $checkResult->fetch_assoc()) {
        $remainingMembers[] = $row['StudentID'];
    }
}

$teamDeleted = false;

if (count($remainingMembers) == 0) {
    // No members left — delete the team
    $deleteTeam = "
    DELETE 
    FROM Team 
    WHERE ID = $teamID";
    $conn->query($deleteTeam);
    $teamDeleted = true;
} else if ($isLeader) {
    $newLeaderID = min($remainingMembers); // pick lowest StudentID
    $updateLeader = "
    UPDATE Team 
    SET LeaderID = $newLeaderID 
    WHERE ID = $teamID";
    $conn->query($updateLeader);
}

$location = "dashboard.php?studentID=$studentID";
if ($teamDeleted) {
    $location .= "&deletedTeam=true";
}

header("Location: $location");
exit;
?>
