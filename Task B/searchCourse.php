<?php
include 'db.php';

$studentID = $_GET ['studentID'] ?? null;
if (!$studentID) {
    die("No student ID submitted.");
}

$courseID = $_GET ['courseID'] ?? '';
$courseName = $_GET ['courseName'] ?? '';
$courseSemester = $_GET ['semester'] ?? '';
$courseYear = $_GET ['year'] ?? null;
$courseProfessor = $_GET ['professor'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Search Course</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!--Search for Courses-->
        <form>
            <h1>Search Course</h1>
            <label for="courseID">Department/Course ID:</label>
            <input type="text" id="courseID" name="courseID" value = "<?= htmlspecialchars($courseID) ?>">

            <label for="courseName">Course Name:</label>
            <input type="text" id="courseName" name="courseName" value = "<?= htmlspecialchars($courseName) ?>">

            <?php 
            $springSelected = '';
            $fallSelected = '';
            $summerSelected = '';
            if ($courseSemester === 'Spring') {
                $springSelected = 'selected';
            } elseif ($courseSemester === 'Fall') {
                $fallSelected = 'selected';
            } elseif ($courseSemester === 'Summer') {
                $summerSelected = 'selected';
            }
            ?>

            <label for="semester">Semester:</label>
            <select id="semester" name="semester">
                <option value="">Any</option>
                <option value="Spring" <?=$springSelected?>>Spring</option>
                <option value="Fall" <?=$fallSelected?>>Fall</option>
                <option value="Summer" <?=$summerSelected?>>Summer</option>
            </select>

            <label for="year">Year:</label>
            <input type="number" id="year" name="year" min="2000" max="2100" value = <?= htmlspecialchars($courseYear) ?>>

            <label for="professor">Professor:</label>
            <select name="professor">
                <option value="">Any</option>
                <?php
                $professorQuery = "SELECT Name FROM Professor";
                $professorResult = $conn->query($professorQuery);
                
                while ($row = $professorResult->fetch_assoc()):
                    $profName = htmlspecialchars($row['Name']);
                    $isSelected = $courseProfessor === $profName ? 'selected' : '';
                ?>
                    <option value="<?= $profName ?>" <?= $isSelected ?>><?= $profName ?></option>
                <?php endwhile; ?>
            </select>

            <input type="hidden" name="studentID" value="<?= $studentID ?>">

            <button type="submit">Search</button>  
        </form>

        <!-- Course List -->
        <?php
        $query =
        "SELECT c.ID as courseID, c.Name as courseName, c.Semester as courseSemester, c.Year as courseYear, p.Name as professorName 
        FROM Course c
        JOIN Professor p ON c.ProfessorID = p.ID
        WHERE c.ID LIKE '%$courseID%'
        AND c.Name LIKE '%$courseName%'
        AND c.Semester LIKE '%$courseSemester%'
        AND p.Name LIKE '%$courseProfessor%'";
        if(!empty($courseYear)){
            $query .= " AND c.Year = $courseYear";
        }
        $result = $conn->query($query);
        if(!$result){
            die("Query failed: " . $conn->error . "<br><pre>$query</pre>");
        }

        $enrolledCoursesQuery = 
        "SELECT c.ID
        FROM Course c
        JOIN Enrollment e
        ON c.ID = e.CourseID
        WHERE e.StudentID = $studentID";
        $enrolledCoursesResult = $conn->query($enrolledCoursesQuery);
        
        $enrolledCourses = [];
        if ($enrolledCoursesResult) {
            while ($row = $enrolledCoursesResult->fetch_assoc()) {
                $enrolledCourses[] = $row['ID'];
            }
        }
        ?>

        <div>
            <h3>Search Results:</h3>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <th>Class ID</th>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Year</th>
                        <th>Professor</th>
                        <th>Actions</th>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['courseID'] ?></td>
                            <td><?= $row['courseName'] ?></td>
                            <td><?= $row['courseSemester'] ?></td>
                            <td><?= $row['courseYear'] ?></td>
                            <td><?= $row['professorName'] ?></td>

                            <?php if(!in_array($row['courseID'], $enrolledCourses)): ?>
                                <td>
                                    <form method="get" action="addCourse.php">
                                        <input type="hidden" name="studentID" value="<?= $studentID ?>">
                                        <input type="hidden" name="courseID" value="<?= $row['courseID'] ?>">
                                        <button type="submit">Enroll</button>
                                    </form>
                                </td>
                            <?php else: ?>
                                <td><em>Already Enrolled</em></td>
                            <?php endif; ?>
                        </tr>
                     <?php endwhile; ?>
                </table>
            <?php endif; ?>
        </div>

        <div>
            <form method="get" action="dashboard.php">
                <input type="hidden" name="studentID" value="<?= $studentID ?>">
                <button type="submit">Back to Dashboard</button> 
            </form>
        </div>
    </body>
</html>