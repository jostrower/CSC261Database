<?php
include 'db.php';

$studentID = $_GET['studentID'] ?? null;

if (!$studentID) {
    die("No student ID submitted.");
}

$studentNameQuery = "SELECT Name FROM Student WHERE ID = $studentID";
$studentNameResult = $conn->query("$studentNameQuery");
$studentName = "Student";
if ($studentNameResult->num_rows > 0) {
    $row = $studentNameResult->fetch_assoc();
    $studentName = $row['Name'];
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
        <h1>Student Dashboard</h1>
        <h2>Welcome, <?=$studentName?>!</h2>
        
        <div>
            <h3>Your courses:</h3>
            <table>
                <thead>
                    <th>Class ID</th>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Year</th>
                    <th>Professor</th>
                    <th>Actions</th>
                </thead>
                <?php
                if ($courseQueryResult->num_rows > 0) {
                    while ($row = $courseQueryResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['Semester'] ?></td>
                            <td><?= $row['Year'] ?></td>
                            <td><?= $row['ProfessorName'] ?></td>
                            <td>
                                
                                <button onclick="alert('Remove Class')">Remove</button>
                            </td>
                        </tr>
                    <?php endwhile;
                } else {
                    echo "<li>No courses found.</li>";
                }
                ?>
            </table>
        </div>

        <div>
            <h3>Your teams:</h3>
            <table>
                <thead>
                    <th>Team ID</th>
                    <th>Name</th>
                    <th>Course ID</th>
                    <th>Actions</th>
                </thead>
                <?php
                if ($teamQueryResult->num_rows > 0) {
                    while ($row = $teamQueryResult->fetch_assoc()): 
                        $teamID = $row['ID'];
                        
                        $teamMemberQuery = 
                        "SELECT s.name
                        FROM Student s
                        JOIN TeamMember t
                        ON s.ID = t.StudentID
                        WHERE t.TeamID = $teamID;";
                        $teamMemberQueryResult = $conn->query($teamMemberQuery);
                        ?>

                        <tr>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['CourseID'] ?></td>
                            <td>
                                <button onclick="alert('Edit Class')">Edit</button>
                                <button onclick="alert('Remove Class')">Remove</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan = "4">
                                <strong>Members:</strong>
                                <ul>
                                    <?php while ($row2 = $teamMemberQueryResult->fetch_assoc()): ?>
                                        <li><?= $row2['name'] ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endwhile;
                } else {
                    echo "<li>No courses found.</li>";
                }
                ?>
            </table>
        </div>
    </body>
</html>