<?php
session_start();
include 'db_connect.php'; // connect to your database

$message = '';

// ✅ Create default admin account if none exists (hidden from user)
$default_username = 'admin';
$default_password = 'DessaMae123'; // default password
$hashed_password = password_hash($default_password, PASSWORD_DEFAULT);


// ✅ Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $query = $conn->prepare("SELECT * FROM admin WHERE username = ?");
  $query->bind_param("s", $username);
  $query->execute();
  $result = $query->get_result();

  if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
      $_SESSION['admin_logged_in'] = true;
      $_SESSION['admin_name'] = $admin['username'];
      header("Location: admin.php");
      exit();
    } else {
      $message = "❌ Incorrect password.";
    }
  } else {
    $message = "⚠️ Admin not found.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login | Fresh Fruits Paradise</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #ff9f00, #ffcc33);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .login-container {
      background: #fff8e1;
      padding: 3em 2.5em;
      border-radius: 25px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      width: 360px;
      text-align: center;
      animation: fadeIn 1s ease;
      position: relative;
      z-index: 1;
    }

    .login-container h2 {
      color: #ff7b00;
      font-size: 2em;
      margin-bottom: 0.5em;
    }

    .login-container p {
      color: #555;
      margin-bottom: 2em;
    }

    .input-group {
      display: flex;
      flex-direction: column;
      text-align: left;
      margin-bottom: 1.5em;
    }

    .input-group label {
      font-weight: 600;
      color: #444;
      margin-bottom: 0.3em;
    }

    .input-group input {
      padding: 0.8em;
      border: 2px solid #ffb74d;
      border-radius: 10px;
      outline: none;
      font-size: 1em;
      transition: 0.3s ease;
    }

    .input-group input:focus {
      border-color: #ff9100;
      box-shadow: 0 0 8px rgba(255,145,0,0.5);
    }

    .login-btn {
      width: 100%;
      padding: 0.9em;
      background: linear-gradient(135deg, #ff7b00, #ffcc33);
      border: none;
      border-radius: 30px;
      color: white;
      font-size: 1.1em;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(255,136,0,0.3);
    }

    .login-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(255,136,0,0.6);
    }

    .message {
      margin-top: 1em;
      color: #d32f2f;
      font-weight: 600;
      background: #fff3e0;
      border-radius: 10px;
      padding: 0.6em;
      animation: fadeIn 0.5s ease;
    }

    footer {
      margin-top: 2em;
      color: #777;
      font-size: 0.9em;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Floating Fruits Background */
    .fruit-bg {
      position: absolute;
      font-size: 4em;
      opacity: 0.1;
      animation: float 6s ease-in-out infinite;
      z-index: 0;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-15px); }
    }

    .fruit1 { top: 10%; left: 15%; animation-delay: 0s; }
    .fruit2 { top: 60%; left: 80%; animation-delay: 1s; }
    .fruit3 { top: 80%; left: 30%; animation-delay: 2s; }
  </style>
</head>
<body>
  <!-- Floating Fruit Emojis 🍎🍊🍓 -->
  <div class="fruit-bg fruit1">🍎</div>
  <div class="fruit-bg fruit2">🍊</div>
  <div class="fruit-bg fruit3">🍓</div>

  <div class="login-container">
    <h2>Admin Login</h2>
    <p>🍍 Fresh Fruits Paradise 🍌</p>

    <form method="POST" action="">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required />
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
      </div>

      <button type="submit" class="login-btn">Login</button>
    </form>

    <?php if ($message): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <footer>© 2025 Fresh Fruits Paradise 🍉</footer>
  </div>
</body>
</html>
