<?php
session_start();
// if (!isset($_SESSION['admin_name'])) {
//     header("Location: admin_login.php");
//     exit;
// }

include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST["course"];
    $section = $_POST["section"];
    $semester = $_POST["semester"];
    $role = $_POST["role"]; // 'student' or 'teacher'

    // File Upload
    $targetDir = "uploads/timetables/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["timetable"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["timetable"]["tmp_name"], $targetFilePath)) {
        // Store in database
        $sql = "INSERT INTO timetables (course, section, semester, role, timetable_file) 
                VALUES ('$course', '$section', '$semester', '$role', '$targetFilePath')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Timetable uploaded successfully!'); window.location.href='admin_upload_timetable.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "File upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Timetable</title>
    <link rel="stylesheet" href="styles_admin_student_teacher_timetable.css">

</head>
<body>
    <h2>Upload Timetable</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Course:</label>
        <input type="text" name="course" required>
        <br>
        <label>Section:</label>
        <input type="text" name="section" required>
        <br>
        <label>Semester:</label>
        <input type="text" name="semester" required>
        <br>
        <label>Upload Timetable (PDF, Image):</label>
        <input type="file" name="timetable" accept=".pdf, .jpg, .png" required>
        <br>
        <label>For:</label>
        <select name="role">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
