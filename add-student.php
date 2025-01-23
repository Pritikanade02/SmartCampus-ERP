<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartcampus_db"; 

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data from admin
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];

    // Insert data into the student table
    $sql = "INSERT INTO student (username, password, first_name, email, course, semester)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $password, $first_name, $email, $course, $semester);

    if ($stmt->execute()) {
        echo "Student added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

// Close the connection
$conn->close();
?>
