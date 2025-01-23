<?php
session_start();  // Start the session at the top of the file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch username and password from the form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if the fields are not empty
    if (empty($username) || empty($password)) {
        echo "Username or password cannot be empty.";
        exit;
    }

    // Proceed with login logic
    $conn = new mysqli("localhost", "root", "", "smartcampus_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to validate login
    $query = "SELECT * FROM student WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);  // Bind username to the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        if ($password === $student['password']) {  // Match password directly (no hashing)
            // Set session variables for student info
            $_SESSION['student_id'] = $student['id'];
            $_SESSION['student_name'] = $student['first_name'] . " " . $student['last_name'];
            $_SESSION['course'] = $student['course'];
            $_SESSION['semester'] = $student['semester'];

            // Redirect to student dashboard
            header("Location: student-dashboard.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>

