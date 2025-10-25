<?php
// --- Database Connection ---
// Update these with your actual database details

$servername = "sql104.infinityfree.com"; // or your host name (e.g., sql210.infinityfree.com)
$username   = "if0_40250859";      // your MySQL username
$password   = "Dessa1234567";          // your MySQL password
$dbname     = "if0_40250859_db_fruits"; // your database name

// --- Create Connection ---
$conn = new mysqli($servername, $username, $password, $dbname);

// --- Check Connection ---
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Uncomment this line to confirm connection during testing
// echo "Connected successfully!";
?>
