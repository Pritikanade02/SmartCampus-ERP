<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartcampus_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$course = $_POST['course'];
$section = $_POST['section'];

$sql = "SELECT id, first_name FROM student WHERE course = ? AND section = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $course, $section);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Student Name</th><th>Present</th><th>Absent</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['first_name']}</td>
                <td><input type='radio' name='attendance[{$row['id']}]' value='P' required></td>
                <td><input type='radio' name='attendance[{$row['id']}]' value='A' required></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No students found!";
}

$stmt->close();
$conn->close();
?>
