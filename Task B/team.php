<?php
include 'db.php';

$studentID = $_GET['studentID'] ?? null;
$teamID = $_GET['teamID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}
if (!$teamID) {
    die("No team ID submitted.");
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>View Team</title>
    </head>
    <body>
        <h1>Your Team:</h1>
        <h2>Team ID: <?=$teamID?></h2>

        <?php
        $teamQuery = "SELECT * FROM Team WHERE ID = $teamID";
        $teamResult = $conn->query($teamQuery);
        if ($teamResult && $teamResult->num_rows > 0):
            $row = $teamResult->fetch_assoc();?>
            <form method="POST" action="updateTeamName.php">
                <input type="hidden" name="teamID" value="<?= $teamID ?>">
                <input type="hidden" name="studentID" value="<?= $studentID ?>">
                <label for="teamName"> <strong>Team Name:</strong></label>
                <input type="text" name="teamName" id="teamName" value="<?= htmlspecialchars($row['Name']) ?>" required>
                <button type="submit">Update Name</button>
            </form>
        <?php else :
            echo "<p>No team information found.</p>";
        endif;
        ?>

        <h3>Team Members:</h3>
        <?php
        $membersQuery = "SELECT s.Name, s.ID FROM TeamMember tm JOIN Student s ON tm.StudentID = s.ID WHERE tm.TeamID = $teamID";
        $membersResult = $conn->query($membersQuery);
        if ($membersResult && $membersResult->num_rows > 0): ?>
            <ul>
                <?php while ($memberRow = $membersResult->fetch_assoc()): ?>
                    <li>
                        <?php if ($memberRow['ID'] != $studentID): ?>
                            <form method="POST" action="removeTeamMember.php" style="display:inline;">
                                <?= htmlspecialchars($memberRow['Name']) ?> (ID: <?= $memberRow['ID'] ?>)
                                <input type="hidden" name="teamID" value="<?= $teamID ?>">
                                <input type="hidden" name="studentID" value="<?= $studentID ?>">
                                <input type="hidden" name="removedID" value="<?= $memberRow['ID'] ?>">
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

        <form>
            <h3>Return to your Dashboard:</h3>
            <input type="hidden" name="studentID" value="<?= $studentID ?>">
            <button type="submit" formaction="dashboard.php">Dashboard</button>
        </form>

    </body>
</html>