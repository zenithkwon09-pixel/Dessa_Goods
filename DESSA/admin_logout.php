<?php
session_start();

// If admin confirms logout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_unset();
  session_destroy();
  echo "<script>alert('You have been logged out successfully 🍎'); window.location.href='admin_login.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logout | Admin Panel</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #ff7b00, #ffbb33);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .logout-container {
      background: #fffaf2;
      padding: 2.5em;
      border-radius: 25px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      width: 90%;
      max-width: 430px;
      text-align: center;
      position: relative;
      animation: popIn 1s ease;
    }

    .logout-container h2 {
      color: #ff6a00;
      font-size: 2em;
      margin-bottom: 0.5em;
    }

    .logout-container p {
      color: #555;
      font-size: 1.1em;
      margin-bottom: 1.5em;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      gap: 1.5em;
    }

    button, a {
      padding: 0.9em 1.6em;
      border-radius: 30px;
      font-size: 1em;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
      border: none;
      text-decoration: none;
    }

    .confirm-btn {
      background: linear-gradient(135deg, #ff4b2b, #ff9068);
      color: white;
      box-shadow: 0 4px 10px rgba(255, 94, 98, 0.3);
    }

    .confirm-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(255, 107, 53, 0.5);
    }

    .cancel-btn {
      background: #fff0e0;
      color: #ff6a00;
      border: 2px solid #ffb366;
    }

    .cancel-btn:hover {
      background: #ff6a00;
      color: #fff;
      transform: scale(1.05);
    }

    .fruit {
      position: absolute;
      opacity: 0.12;
      width: 70px;
      animation: float 6s ease-in-out infinite;
      z-index: -1;
    }

    .fruit1 { top: 10%; left: 8%; animation-delay: 0s; }
    .fruit2 { bottom: 10%; right: 10%; animation-delay: 2s; }
    .fruit3 { top: 50%; right: 15%; animation-delay: 4s; }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }

    @keyframes popIn {
      from {
        opacity: 0;
        transform: scale(0.8);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    footer {
      position: absolute;
      bottom: 1em;
      color: #fffbe9;
      font-size: 0.9em;
      text-align: center;
    }

    @media (max-width: 480px) {
      .logout-container {
        padding: 2em;
      }
      .logout-container h2 {
        font-size: 1.6em;
      }
    }
  </style>
</head>
<body>
  <!-- Floating fruit decorations -->
  <img src="banana.png" class="fruit fruit1" alt="Banana">
  <img src="orange.png" class="fruit fruit2" alt="Orange">
  <img src="strawberry.png" class="fruit fruit3" alt="Strawberry">

  <div class="logout-container">
    <h2>Logging Out 🍍</h2>
    <p>Are you sure you want to log out, Admin? We’ll miss your juicy energy!</p>

    <form method="POST">
      <div class="btn-group">
        <button type="submit" class="confirm-btn">Yes, Logout</button>
        <a href="admin_logged_in.php" class="cancel-btn">Cancel</a>
      </div>
    </form>
  </div>

  <footer>© 2025 Fresh Fruits Paradise | Admin Panel 🍓</footer>
</body>
</html>
