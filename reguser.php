<?php
function validate_password($password) {
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Password must include at least one uppercase letter.";
    }
    if (!preg_match("/[a-z]/", $password)) {
        return "Password must include at least one lowercase letter.";
    }
    if (!preg_match("/[0-9]/", $password)) {
        return "Password must include at least one number.";
    }
    if (!preg_match("/[\W]/", $password)) {
        return "Password must include at least one special character.";
    }
    return true;
}

if (isset($_POST['register'])) {
    $user = $_POST['uname'];
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];

    // Validate password
    $password_validation = validate_password($pwd);
    if ($password_validation !== true) {
        echo "<script>alert('$password_validation'); window.location.href='reguser.html';</script>";
        exit();
    }

    // Hash the password
    $hash = password_hash($pwd, PASSWORD_BCRYPT);

    // Create database query
    $query = "INSERT INTO `admin`(`uname`, `pwd`, `email`) VALUES ('$user','$hash','$email')";

    // Execute the query
    $run = mysqli_query($con, $query);

    if ($run) {
        echo "<script>alert('User has been added Successfully'); window.location.href='reguser.html';</script>";
    } else {
        echo "<script>alert('Error: Could not register user'); window.location.href='reguser.html';</script>";
    }
}
?>
