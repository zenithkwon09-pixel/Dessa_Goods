<?php
include 'db_connect.php'; // make sure this file connects correctly to your MySQL database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $fullname, $email, $password);

  if ($stmt->execute()) {
    echo "<script>alert('Account created successfully!'); window.location.href='index.php';</script>";
  } else {
    echo "<script>alert('Error: Could not create account.'); window.history.back();</script>";
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
  <title>Sign Up | Fresh Fruits Paradise</title>
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
      color: #333;
    }

    .signup-container {
      background: #fffaf2;
      padding: 2.5em;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      width: 90%;
      max-width: 420px;
      text-align: center;
      animation: fadeIn 1s ease;
    }

    .signup-container h2 {
      color: #ff7b00;
      font-size: 2em;
      margin-bottom: 1em;
    }

    .signup-container p {
      color: #777;
      margin-bottom: 1.5em;
    }

    .signup-container form {
      display: flex;
      flex-direction: column;
      gap: 1.2em;
    }

    .signup-container input {
      padding: 0.9em 1em;
      border: 2px solid #ffe1a6;
      border-radius: 30px;
      outline: none;
      transition: 0.3s;
      font-size: 1em;
    }

    .signup-container input:focus {
      border-color: #ff7b00;
      box-shadow: 0 0 10px rgba(255,123,0,0.3);
    }

    .signup-container button {
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      color: white;
      padding: 0.9em;
      border: none;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      font-size: 1em;
    }

    .signup-container button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(255,193,7,0.5);
    }

    .signup-container .back-link {
      display: inline-block;
      margin-top: 1em;
      color: #ff7b00;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .signup-container .back-link:hover {
      color: #e66600;
      transform: scale(1.05);
    }

    /* Subtle entry animation */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive */
    @media (max-width: 480px) {
      .signup-container {
        padding: 2em;
      }
      .signup-container h2 {
        font-size: 1.6em;
      }
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <h2>Join Fresh Fruits Paradise 🍍</h2>
    <p>Create your account and start your healthy journey!</p>

    <form action="register_user.php" method="POST">
      <input type="text" name="fullname" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Sign Up</button>
    </form>

    <a href="index.html" class="back-link">← Back to Home</a>
  </div>
</body>
</html>
