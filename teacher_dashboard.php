<?php
session_start();
if (!isset($_SESSION['teacher_name'])) {
    header("Location: teacher_login.html");
    exit;
}

// Fetch session data
$teacherName = $_SESSION['teacher_name'];
//$course = $_SESSION['course'];
//$semester = $_SESSION['semester'];
// $photo = $_SESSION['photo'];
// $rollNumber = $_SESSION['roll_number'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="teacher_dashboard.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="teacher_dashboard.php" class="active">Dashboard</a></li>
            <li><a href="mark-attendance.php">Mark Attendance</a></li>
            <li><a href="upload-assignment.php">Upload Assignment</a></li>
            <li><a href="#">Events</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>Welcome, <?php echo $teacherName; ?></h1>
            <p>Select an option from the menu to get started.</p>
        </header>
        <!-- Features Section -->
        <section class="features">
            <div class="feature-block">
                <a href="mark-attendance.php">
                    <h3>Mark Attendance</h3>
                </a>
            </div>
            <div class="feature-block">
                <a href="upload-assignment.php">
                    <h3>Upload Assignment</h3>
                </a>
            </div>
            <div class="feature-block">
                <a href="upload_event.php">
                    <h3>Upload Events</h3>
                </a>
            </div>
        </section>
    </div>
</body>
</html>