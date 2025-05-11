<?php
session_start();

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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query to fetch user data
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store session data
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Set cookies for session management
            setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // 30 days expiry
            setcookie('username', $user['username'], time() + (86400 * 30), "/");

            echo "Login successful!";
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
    $conn->close();
}
?>
