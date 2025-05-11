<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $form_data = mysqli_real_escape_string($conn, $_POST['form_data']);

    $sql = "INSERT INTO submissions (user_id, form_data) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $form_data);

    if ($stmt->execute()) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
