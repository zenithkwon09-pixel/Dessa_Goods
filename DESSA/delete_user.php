<?php
include 'db_connect.php';

// Ensure 'id' is provided
if (!isset($_GET['id'])) {
  echo "<script>alert('No user selected!'); window.location.href='admin_logged_in.php';</script>";
  exit;
}

$user_id = $_GET['id'];

// Fetch user info
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
  echo "<script>alert('User not found!'); window.location.href='admin_logged_in.php';</script>";
  exit;
}

// Handle deletion confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);

  if ($stmt->execute()) {
    echo "<script>alert('User deleted successfully!'); window.location.href='admin.php';</script>";
  } else {
    echo "<script>alert('Error deleting user.'); window.history.back();</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delete User | Fresh Fruits Paradise</title>
  <style>
    /* Global styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #ff9966, #ff5e62);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      color: #333;
    }

    .delete-container {
      background: #fffaf2;
      padding: 2.5em;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
      width: 90%;
      max-width: 460px;
      text-align: center;
      animation: slideUp 1s ease;
      position: relative;
    }

    .delete-container h2 {
      color: #ff5e00;
      font-size: 2em;
      margin-bottom: 0.5em;
    }

    .delete-container p {
      color: #555;
      margin-bottom: 1.5em;
      font-size: 1.1em;
    }

    .user-info {
      background: #fff3e0;
      padding: 1em;
      border-radius: 15px;
      margin-bottom: 1.5em;
      box-shadow: inset 0 0 10px rgba(255,94,98,0.1);
      transition: transform 0.3s ease;
    }

    .user-info:hover {
      transform: scale(1.02);
    }

    .user-info strong {
      color: #ff5e00;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      gap: 1.5em;
    }

    button, a.back {
      padding: 0.9em 1.5em;
      border-radius: 30px;
      border: none;
      font-weight: 600;
      cursor: pointer;
      font-size: 1em;
      transition: 0.3s ease;
    }

    .confirm-btn {
      background: linear-gradient(135deg, #ff5e00, #ff9966);
      color: #fff;
      box-shadow: 0 4px 10px rgba(255, 94, 98, 0.3);
    }

    .confirm-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(255, 94, 98, 0.4);
    }

    .back {
      background: #fff3e0;
      color: #ff5e00;
      border: 2px solid #ffb088;
      text-decoration: none;
    }

    .back:hover {
      background: #ff5e00;
      color: white;
      transform: scale(1.05);
    }

    /* Floating fruit decorations */
    .fruit {
      position: absolute;
      opacity: 0.12;
      width: 70px;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }

    .fruit1 { top: 10%; left: 8%; animation-delay: 0s; }
    .fruit2 { bottom: 10%; right: 10%; animation-delay: 2s; }
    .fruit3 { top: 50%; right: 15%; animation-delay: 4s; }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
      .delete-container {
        padding: 2em;
      }
      .delete-container h2 {
        font-size: 1.6em;
      }
    }
  </style>
</head>
<body>
  <img src="orange.png" class="fruit fruit1" alt="">
  <img src="apple.png" class="fruit fruit2" alt="">
  <img src="banana.png" class="fruit fruit3" alt="">

  <div class="delete-container">
    <h2>Delete User 🍓</h2>
    <p>Are you sure you want to remove this user? This action cannot be undone.</p>

    <div class="user-info">
      <p><strong>Name:</strong> <?= htmlspecialchars($user['fullname']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>

    <form method="POST">
      <div class="btn-group">
        <button type="submit" class="confirm-btn">Yes, Delete</button>
        <a href="admin_logged_in.php" class="back">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
