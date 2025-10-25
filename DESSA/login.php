<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  // Check if the email exists
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      // Login successful
      $_SESSION['user'] = $user['fullname'];
      echo "<script>
              alert('Welcome back, " . $user['fullname'] . "! 🍓');
              window.location.href='index.php';
            </script>";
      exit();
    } else {
      echo "<script>alert('Incorrect password! Please try again.'); window.history.back();</script>";
    }
  } else {
    echo "<script>alert('No account found with that email. Please sign up first.'); window.location.href='login.php';</script>";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Fresh Fruits Paradise</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
      color: #333;
    }

    .login-container {
      background: #fffaf2;
      padding: 2.5em;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      width: 90%;
      max-width: 400px;
      text-align: center;
      position: relative;
      animation: slideIn 1s ease;
    }

    .login-container::before {
      content: "🍉";
      font-size: 2em;
      position: absolute;
      top: -25px;
      left: 50%;
      transform: translateX(-50%);
      background: #ff7b00;
      color: white;
      padding: 0.4em 0.6em;
      border-radius: 50%;
      box-shadow: 0 0 15px rgba(255, 123, 0, 0.6);
    }

    .login-container h2 {
      color: #ff7b00;
      font-size: 2em;
      margin-bottom: 0.5em;
    }

    .login-container p {
      color: #777;
      margin-bottom: 1.5em;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1.2em;
    }

    input {
      padding: 0.9em 1em;
      border: 2px solid #ffe1a6;
      border-radius: 30px;
      outline: none;
      transition: 0.3s;
      font-size: 1em;
    }

    input:focus {
      border-color: #ff7b00;
      box-shadow: 0 0 10px rgba(255,123,0,0.3);
    }

    button {
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      color: white;
      padding: 0.9em;
      border: none;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 1em;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(255,193,7,0.5);
    }

    .link {
      display: block;
      margin-top: 1em;
      color: #ff7b00;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    .link:hover {
      color: #e66600;
      transform: scale(1.05);
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 2em;
      }
      .login-container h2 {
        font-size: 1.7em;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Welcome Back 🍓</h2>
    <p>Log in to continue your healthy journey!</p>

    <form action="login.php" method="POST">
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Log In</button>
    </form>

    <a href="signup.php" class="link">Don’t have an account? Sign Up 🍍</a>
    <a href="index.html" class="link">← Back to Home</a>
  </div>
</body>
</html>
