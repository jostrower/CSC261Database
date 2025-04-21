<?php
include 'db.php';

$ID = $_GET['ID'] ?? null;
$teamID = $_GET['teamID'] ?? null;
$type = $_GET['type'] ?? null;
$courseID = $_GET['courseID'] ?? null;

if (!$ID) {
    die("No ID submitted.");
}
if (!$teamID) {
    die("No team ID submitted.");
}
if (!$type) {
    die("No type submitted.");
}
if (!$courseID) {
    die("No course ID submitted.");
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>View Team</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!-- Header -->
        <h1>Your Team:</h1>
        <h2>Team ID: <?=$teamID?></h2>

        <!-- Name Change -->
        <?php
        $teamQuery = "SELECT * FROM Team WHERE ID = $teamID";
        $teamResult = $conn->query($teamQuery);
        if ($teamResult && $teamResult->num_rows > 0):
            $row = $teamResult->fetch_assoc();?>
            <form method="POST" action="updateTeamName.php">
                <input type="hidden" name="teamID" value="<?= $teamID ?>">
                <input type="hidden" name="ID" value="<?= $ID ?>">
                <input type="hidden" name="type" value="<?= $type ?>">
                <input type="hidden" name="courseID" value="<?= $courseID ?>">
                <label for="teamName"> <strong>Team Name:</strong></label>
                <input type="text" name="teamName" id="teamName" value="<?= htmlspecialchars($row['Name']) ?>" required>
                <button type="submit">Update Name</button>
            </form>
        <?php else :
            echo "<p>No team information found.</p>";
        endif;
        ?>

        <!-- Team Members -->
        <h3>Team Members:</h3>
        <?php
        $membersQuery = "SELECT s.Name, s.ID FROM TeamMember tm JOIN Student s ON tm.StudentID = s.ID WHERE tm.TeamID = $teamID";
        $membersResult = $conn->query($membersQuery);
        if ($membersResult && $membersResult->num_rows > 0): ?>
            <ul>
                <?php while ($memberRow = $membersResult->fetch_assoc()): ?>
                    <li>
                        <?php if ($memberRow['ID'] != $ID || $type != "student"): ?>
                            <form method="POST" action="removeTeamMember.php" style="display:inline;">
                                <?= htmlspecialchars($memberRow['Name']) ?> (ID: <?= $memberRow['ID'] ?>)
                                <input type="hidden" name="teamID" value="<?= $teamID ?>">
                                <input type="hidden" name="ID" value="<?= $ID ?>">
                                <input type="hidden" name="removedID" value="<?= $memberRow['ID'] ?>">
                                <input type="hidden" name="courseID" value="<?= $courseID ?>">
                                <input type="hidden" name="type" value="<?= $type ?>">
                                <button type="submit">Remove</button>
                            </form>
                        <?php else: ?>
                            <strong><?= htmlspecialchars($memberRow['Name']) ?> (You)</strong>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No team members found.</p>
        <?php endif; ?>

        <!-- Back to Dashboard -->
        <?php if ($type == 'student'): ?>
            <form method="get" action="dashboard.php">
                <input type="hidden" name="studentID" value="<?= $ID ?>">
                <button type="submit">Back to Dashboard</button>
            </form>
        <?php elseif ($type == 'professor'): ?>
            <form method="get" action="viewTeams.php">
                <input type="hidden" name="ID" value="<?= $ID ?>">
                <input type="hidden" name="courseID" value="<?= $courseID ?>">
                <input type="hidden" name="type" value="<?= $type ?>">
                <button type="submit">Back to Teams</button>
            </form>
        <?php endif; ?>

    </body>
</html>