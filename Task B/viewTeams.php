<?php
include 'db.php';

$studentID = $_GET ['studentID'] ?? null;
$courseID = $_GET ['courseID'] ?? null;

if ($studentID == null || $courseID == null) {
    die("No student ID or course ID submitted.");
}

$teamQuery = "
SELECT *
FROM Team
WHERE CourseID = '$courseID'";
$teamQueryResult = $conn ->query($teamQuery);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>View Teams</title>
    </head>
    <body>
        <h1>View Teams</h1>
        <h2>Course ID: <?= htmlspecialchars($courseID) ?></h2>
        
        <!-- Team List -->
        <div>
            <h3>Your teams:</h3>
            <?php if ($teamQueryResult->num_rows > 0): ?>
                <table>
                    <thead>
                        <th>Team ID</th>
                        <th>Team Name</th>
                        <th>Team Members</th>
                        <th>Actions</th>
                    </thead>
                    <?php while ($row = $teamQueryResult->fetch_assoc()): ?>
                        <?php $alreadyMember = false; ?>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Name'] ?></td>

                            <?php
                            $memberQuery = "
                            SELECT s.Name, s.ID
                            FROM TeamMember tm
                            JOIN Student s ON tm.StudentID = s.ID
                            WHERE tm.TeamID = $row[ID]
                            ";
                            $memberQueryResult = $conn->query($memberQuery);
                            ?>
                            <td>
                                <ul>
                                    <?php while ($memberRow = $memberQueryResult->fetch_assoc()): ?>
                                        <?php if ($memberRow['ID'] == $studentID): ?>
                                            <li><strong><?= htmlspecialchars($memberRow['Name']) ?> (You)</strong></li>
                                            <?php $alreadyMember = true; ?>
                                        <?php else: ?>
                                            <li><?= htmlspecialchars($memberRow['Name']) ?> (ID: <?= htmlspecialchars($memberRow['ID']) ?>)</li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            </td>

                            <?php if (!$alreadyMember): ?>
                                <td>
                                    <form method="post" action="joinTeam.php">
                                        <input type="hidden" name="studentID" value="<?= $studentID ?>">
                                        <input type="hidden" name="courseID" value="<?= $courseID ?>">
                                        <input type="hidden" name="teamID" value="<?= $row['ID'] ?>">
                                        <button type="submit">Join Team</button>
                                    </form>
                                </td>
                            <?php else: ?>
                                <td><em>Already Member</em></td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else : ?>
                <p>No teams found for this course.</p>
            <?php endif; ?>
        </div>

        <!-- Back to Dashboard -->
        <form method="get" action="dashboard.php">
            <input type="hidden" name="studentID" value="<?= $studentID ?>">
            <button type="submit">Back to Dashboard</button>
        </form>
    </body>