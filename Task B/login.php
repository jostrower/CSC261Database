<?php
include 'db.php';

$ID = $_POST['ID'] ?? null;
$loginType = $_POST['loginType'] ?? null;

if (!$ID) {
    die("No ID submitted.");
}
if (!$loginType) {
    die("No login type submitted.");
}

if($loginType == "1") {
    $sql = "SELECT * FROM Student WHERE ID = $ID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: dashboard.php?studentID=$ID");
        //echo "Student found in database. ID: $studentID";
        exit;
    } else {
        header("Location: registration.html?studentID=$ID");
        //echo "Student not found. Would redirect to registration page.";
        exit;
    }
}
else {
    $sql = "SELECT * FROM Professor WHERE ID = $ID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: profDashboard.php?profID=$ID");
        //echo "Teacher found in database. ID: $teacherID";
        exit;
    } else {
        header("Location: profRegistration.html?profID=$ID");
        //echo "Teacher not found. Would redirect to registration page.";
        exit;
    }
}

//echo "Result rows:" . $result->num_rows ."<br>";
?>
