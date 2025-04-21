<?php 
include("db.php");

$studentID = $_GET ["studentID"] ?? null;
if ($studentID == null) {
    die("No student ID submitted.");
}

$enrolledCoursesQuery = "
SELECT c.ID
FROM Course c
JOIN Enrollment e ON c.ID = e.CourseID
WHERE e.StudentID = $studentID";
$enrolledCourses = $conn->query($enrolledCoursesQuery);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Team</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Create a New Team</h1>

        <form method = "GET" action = "createTeamAction.php">
            <input type="hidden" name="studentID" value="<?= $studentID ?>">

            <label for="courseID">Select a course:</label>
            <select name="courseID" id="courseID" required>
                <?php while ($row = $enrolledCourses->fetch_assoc()): ?>
                    <option value="<?= $row['ID'] ?>"><?= $row['ID'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="teamName">Team Name:</label>
            <input type="text" name="teamName" id="teamName" required>

            <button type="submit">Create Team</button>
        </form>

        <form>
            <input type="hidden" name="studentID" value="<?= $studentID ?>">
            <button type="submit" formaction="dashboard.php">Back to Dashboard</button>
        </form>
    </body>
</html>