<?php
include 'db.php';

// Get professor ID from GET or POST
$profID = $_GET['profID'] ?? $_POST['profID'] ?? null;

if (!$profID) {
    die("No professor ID submitted.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseID = $_POST['courseID'] ?? null;
    $courseName = $_POST['courseName'] ?? null;
    $semester = $_POST['semester'] ?? null;
    $year = $_POST['year'] ?? null;

    if (!$courseID || !$courseName || !$semester || !$year) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        $insert = "
        INSERT INTO Course (ID, Name, Semester, Year, ProfessorID)
        VALUES ('$courseID', '$courseName', '$semester', $year, $profID)";
        
        if ($conn->query($insert)) {
            echo "<script>alert('Course created successfully.');</script>";
        } else {
            echo "<script>alert('Error: {$conn->error}');</script>";
        }

        header("Location: profDashboard.php?profID=$profID");
        exit;
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Create a New Course</h1>
    <form method="post" action="createCourse.php">
        <input type="hidden" name="profID" value="<?= $profID ?>">

        <label for="courseID">Course ID:</label>
        <input type="text" id="courseID" name="courseID" required><br><br>

        <label for="courseName">Course Name:</label>
        <input type="text" id="courseName" name="courseName" required><br><br>

        <label for="semester">Semester:</label>
        <select id="semester" name="semester" required>
            <option value="">Select</option>
            <option value="Spring">Spring</option>
            <option value="Fall">Fall</option>
            <option value="Summer">Summer</option>
        </select><br><br>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>

        <button type="submit">Create Course</button>
    </form>
</body>
</html>
