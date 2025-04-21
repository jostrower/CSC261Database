<?php
include 'db.php';

$ID = $_GET ['ID'] ?? null;
$courseID = $_GET ['courseID'] ?? null;
$type = $_GET ['type'] ?? null;

if(!$ID){
    die("No student ID submitted.");
}
if(!$courseID){
    die("No course ID submitted.");
}
if(!$type){
    die("No type submitted.");
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
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php if (isset($_GET['deletedTeam']) && $_GET['deletedTeam'] === 'true'): ?>
            <script>alert("You removed the last member of the team. The team has been deleted.");</script>
        <?php endif; ?>

        <h1>View Teams</h1>
        <h2>Course ID: <?= htmlspecialchars($courseID) ?></h2>
        
        <!-- Team List -->
        <div>
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
                                        <?php if ($memberRow['ID'] == $ID && $type == 'student'): ?>
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
                                    <?php if ($type == 'student'): ?>
                                        <form method="post" action="joinTeam.php">
                                            <input type="hidden" name="studentID" value="<?= $ID ?>">
                                            <input type="hidden" name="courseID" value="<?= $courseID ?>">
                                            <input type="hidden" name="teamID" value="<?= $row['ID'] ?>">
                                            <button type="submit">Join Team</button>
                                        </form>
                                    <?php elseif ($type == 'professor'): ?>
                                        <form method="get" action="team.php">
                                            <input type="hidden" name="ID" value="<?= $ID ?>">
                                            <input type="hidden" name="teamID" value="<?= $row['ID'] ?>">
                                            <input type="hidden" name="courseID" value="<?= $courseID ?>">
                                            <input type="hidden" name="type" value="professor">
                                            <button type="submit">Edit Team</button>
                                        </form>
                                        <form method="post" action="deleteTeam.php">
                                            <input type="hidden" name="profID" value="<?= $ID ?>">
                                            <input type="hidden" name="courseID" value="<?= $courseID ?>">
                                            <input type="hidden" name="teamID" value="<?= $row['ID'] ?>">
                                            <input type="hidden" name="type" value="professor">
                                            <button type="submit">Delete Team</button>
                                        </form>
                                    <?php endif; ?>
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
        <?php if ($type == 'student'): ?>
            <form method="get" action="dashboard.php">
                <input type="hidden" name="studentID" value="<?= $ID ?>">
                <button type="submit">Back to Dashboard</button>
            </form>
        <?php elseif ($type == 'professor'): ?>
            <form method="get" action="profDashboard.php">
                <input type="hidden" name="profID" value="<?= $ID ?>">
                <button type="submit">Back to Dashboard</button>
            </form>
        <?php endif; ?>
    </body>