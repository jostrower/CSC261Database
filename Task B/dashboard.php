<?php
include 'db.php';

$studentID = $_GET['studentID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}

$studentInfoQuery = "SELECT Name, ID, Major, Year, Email FROM Student WHERE ID = $studentID";
$studentInfoResult = $conn->query($studentInfoQuery);
if ($studentInfoResult && $studentInfoResult->num_rows > 0) {
    $row = $studentInfoResult->fetch_assoc();
    $studentName = $row['Name'];
    $studentMajor = $row['Major'];
    $studentYear = $row['Year'];
    $studentEmail = $row['Email'];
}

$courseQuery = 
"SELECT c.*, p.Name AS ProfessorName
FROM Course c
JOIN Enrollment e 
ON c.ID = e.CourseID
JOIN Professor p
ON c.ProfessorID = p.ID
WHERE e.StudentID = $studentID";
$courseQueryResult = $conn->query($courseQuery);

$teamQuery =
"SELECT t.*
FROM Team t
JOIN TeamMember m
ON t.ID = m.TeamID
WHERE m.StudentID = $studentID";
$teamQueryResult = $conn->query($teamQuery);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Dashboard</title>
    </head>
    <body>
        <!-- Header -->
        <h1>Student Dashboard</h1>
        <h2>Welcome, <?=$studentName?>!</h2>
        <p>
            <strong>ID:</strong> <?= $studentID ?><br>
            <strong>Major:</strong> <?= $studentMajor ?><br>
            <strong>Year:</strong> <?= $studentYear ?><br>
            <strong>Email:</strong> <?= htmlspecialchars($studentEmail) ?>
        </p>
        
        <!-- Course List -->
        <div>
            <h3>Your courses:</h3>
            <form method = "get" action = "searchCourse.php">
                <input type = "hidden" name = "studentID" value = "<?= $studentID ?>">
                <button type="submit">Search for courses</button> 
            </form>
            <?php if ($courseQueryResult->num_rows > 0): ?>
                <table>
                    <thead>
                        <th>Class ID</th>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Year</th>
                        <th>Professor</th>
                        <th>Actions</th>
                    </thead>
                    <?php while ($row = $courseQueryResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['Semester'] ?></td>
                            <td><?= $row['Year'] ?></td>
                            <td><?= $row['ProfessorName'] ?></td>
                            <td>
                                <form method="post" action="dropCourse.php">
                                    <input type="hidden" name="studentID" value="<?= $studentID ?>">
                                    <input type="hidden" name="courseID" value="<?= $row['ID'] ?>">
                                    <button type="submit">Drop</button>
                                </form>
                            </td>
                        </tr>
                     <?php endwhile; ?>
                </table>
            <?php else :
                echo "No courses found.<br>";
            endif; ?>
        </div>
        
        <!-- Team List -->
        <div>
            <h3>Your teams:</h3>
            <form method = "get" action = "searchTeam.php">
                <input type = "hidden" name = "studentID" value = "<?= $studentID ?>">
                <button type="submit">Search for Teams</button> 
            </form>
            <form>
                <button type="submit">Create a team</button> 
            </form>
            <?php if ($teamQueryResult->num_rows > 0): ?>
                <table>
                    <thead>
                        <th>Team ID</th>
                        <th>Name</th>
                        <th>Course ID</th>
                        <th>Actions</th>
                    </thead>
                    <?php while ($row = $teamQueryResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['CourseID'] ?></td>
                            <td>
                                <form method="get" action="team.php">
                                    <input type="hidden" name="studentID" value="<?= $studentID ?>">
                                    <input type="hidden" name="teamID" value="<?= $row['ID'] ?>">
                                    <button type="submit">View</button>
                                </form>
                                <form method="post" action="dropTeam.php">
                                    <input type="hidden" name="studentID" value="<?= $studentID ?>">
                                    <input type="hidden" name="teamID" value="<?= $row['ID'] ?>">
                                    <button type="submit">Leave</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else :
                echo "No teams found.<br>";
            endif; ?>
        </div>

        <!-- Logout Button -->
        <form method="post" action="login.html">
            <button type="submit">Logout</button>
        </form>
    </body>
</html>