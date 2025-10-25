<?php
// Include the database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get form data safely
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($fullname) || empty($email) || empty($password)) {
        echo "<script>alert('Please fill out all fields.'); window.history.back();</script>";
        exit();
    }

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists! Please use another one.'); window.history.back();</script>";
        exit();
    }
    $check->close();

    // Hash password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>
                alert('🎉 Account created successfully! Welcome to Fresh Fruits Paradise 🍍');
                window.location.href='login.php';
              </script>";
    } else {
        echo "<script>
                alert('❌ Error: Unable to create your account. Please try again later.');
                window.history.back();
              </script>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='signup.php';</script>";
}
?>
