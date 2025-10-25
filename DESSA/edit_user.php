<?php
include 'db_connect.php';

// Get user ID from query parameter
if (isset($_GET['id'])) {
  $user_id = $_GET['id'];

  // Fetch existing user info
  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if (!$user) {
    echo "<script>alert('User not found!'); window.location.href='admin_logged_in.php';</script>";
    exit;
  }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET fullname=?, email=?, password=? WHERE id=?");
    $stmt->bind_param("sssi", $fullname, $email, $hashed_password, $user_id);
  } else {
    $stmt = $conn->prepare("UPDATE users SET fullname=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $fullname, $email, $user_id);
  }

  if ($stmt->execute()) {
    echo "<script>alert('User updated successfully!'); window.location.href='admin.php';</script>";
  } else {
    echo "<script>alert('Error updating user.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User | Fresh Fruits Paradise</title>
  <style>
    /* Global styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #ffb347, #ffcc33);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
      overflow: hidden;
    }

    .edit-container {
      background: #fffaf2;
      padding: 2.5em;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.15);
      width: 90%;
      max-width: 480px;
      text-align: center;
      animation: fadeInUp 1s ease;
    }

    .edit-container h2 {
      color: #ff7b00;
      font-size: 2em;
      margin-bottom: 1em;
      position: relative;
    }

    .edit-container h2::after {
      content: '';
      width: 60px;
      height: 4px;
      background: #ffd56a;
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      border-radius: 10px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1em;
      margin-top: 1em;
    }

    input {
      padding: 0.9em 1em;
      border-radius: 30px;
      border: 2px solid #ffe4a3;
      outline: none;
      font-size: 1em;
      transition: all 0.3s ease;
    }

    input:focus {
      border-color: #ff7b00;
      box-shadow: 0 0 10px rgba(255, 123, 0, 0.3);
    }

    button {
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      color: #fff;
      padding: 0.9em;
      border: none;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
      font-size: 1em;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(255,193,7,0.5);
    }

    a.back-link {
      display: inline-block;
      margin-top: 1em;
      color: #ff7b00;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    a.back-link:hover {
      color: #e66600;
      transform: scale(1.05);
    }

    /* Animation */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Floating fruit effect */
    .fruit {
      position: absolute;
      width: 60px;
      opacity: 0.15;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }

    .fruit1 { top: 10%; left: 15%; animation-delay: 0s; }
    .fruit2 { bottom: 15%; right: 20%; animation-delay: 2s; }
    .fruit3 { top: 30%; right: 10%; animation-delay: 4s; }

    @media (max-width: 480px) {
      .edit-container { padding: 2em; }
      .edit-container h2 { font-size: 1.6em; }
    }
  </style>
</head>
<body>
  <img src="orange.png" class="fruit fruit1" alt="">
  <img src="apple.png" class="fruit fruit2" alt="">
  <img src="banana.png" class="fruit fruit3" alt="">

  <div class="edit-container">
    <h2>Edit User 🍎</h2>
    <form method="POST">
      <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
      <input type="password" name="password" placeholder="Leave blank to keep current password">
      <button type="submit">Update User</button>
    </form>
    <a href="admin_logged_in.php" class="back-link">← Back to Dashboard</a>
  </div>
</body>
</html>
