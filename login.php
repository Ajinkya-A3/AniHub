<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "anime_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = mysqli_real_escape_string($conn, $_POST['username']);
    $input_password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT id, username, password FROM users WHERE username = '$input_username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($input_password, $row['password'])) {
            // Password is correct, so start a new session and save the username to the session
            $_SESSION['username'] = $row['username'];
            header("Location: welcome.php"); // Redirect to a welcome page
        } else {
            // Display an error message if password is not valid
            echo "The password you entered was not valid.";
        }
    } else {
        // Display an error message if username doesn't exist
        echo "No account found with that username.";
    }
}

mysqli_close($conn);
?>
