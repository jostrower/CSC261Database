<?php
include 'db.php';

$profID = $_GET['profID'] ?? null;

if (!$profID) {
    die("No teacher ID submitted.");
}

$profInfoQuery = "SELECT * FROM Professor WHERE ID = $profID";
$profInfoResult= $conn->query($profInfoQuery);
if ($profInfoResult && $profInfoResult->num_rows > 0) {
    $row = $profInfoResult->fetch_assoc();
    $profName = $row['Name'];
    $profDepartment = $row['DepartmentID'];
    $profEmail = $row['Email'];
}
else {
    die("No professor found with ID: $profID");
}

$courseQuery = 
"SELECT c.*
FROM Course c
WHERE c.ProfessorID = $profID";
$courseQueryResult = $conn->query($courseQuery);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Professor Dashboard</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="site-header">
            <img src="logo.png" alt="Group Search Logo" class="site-logo">
        </div>
    <a href="welcomePage.html" class="home-button" title="Go to Home">
        <img src="home.png" alt="Home" class="home-icon">
    </a>
        <!-- Header -->
        <h1>Professor Dashboard</h1>
        <h2>Welcome, <?=$profName?>!</h2>
        <p>
            <strong>ID:</strong> <?= $profID ?><br>
            <strong>Department:</strong> <?= $profDepartment ?><br>
            <strong>Email:</strong> <?= htmlspecialchars($profEmail) ?>
        </p>
        
        <!-- Course List -->
        <div>
            <h3>Your courses:</h3>
            <form method = "get" action = "createCourse.php">
                <input type = "hidden" name = "profID" value = "<?= $profID ?>">
                <button type="submit">Create a course</button> 
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
                            <td><?= $profName ?></td>
                            <td>
                                <form method="get" action="viewTeams.php">
                                    <input type="hidden" name="ID" value="<?= $profID ?>">
                                    <input type="hidden" name="type" value="professor">
                                    <input type="hidden" name="courseID" value="<?= $row['ID'] ?>">
                                    <button type="submit">View Teams</button>
                                </form>
                                <form method="get" action="deleteCourse.php">
                                    <input type="hidden" name="profID" value="<?= $profID ?>">
                                    <input type="hidden" name="courseID" value="<?= $row['ID'] ?>">
                                    <button type="submit">Delete Course</button>
                                </form>
                            </td>
                        </tr>
                     <?php endwhile; ?>
                </table>
            <?php else :
                echo "No courses found.<br>";
            endif; ?>
        </div>

        <!-- Logout Button -->
        <form method="post" action="welcomePage.html">
            <button type="submit">Logout</button>
        </form>
    </body>
</html>
