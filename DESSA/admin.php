<?php
session_start();
include 'db_connect.php';

// Optional admin session check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: admin_login.php");
  exit();
}

// Fetch users
$sql = "SELECT id, fullname, email, created_at FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard | Users</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh;
      background: #fffaf2;
      color: #333;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background: linear-gradient(135deg, #ff7b00, #ffbb00);
      color: white;
      padding: 2em 1em;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 2em;
      height: 100vh;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      position: sticky;
      top: 0;
    }

    .sidebar h2 {
      font-size: 1.6em;
      text-align: center;
    }

    .sidebar nav a {
      display: block;
      text-decoration: none;
      color: white;
      font-weight: 600;
      padding: 0.8em 1.2em;
      border-radius: 30px;
      transition: 0.3s ease;
      text-align: center;
    }

    .sidebar nav a:hover {
      background: rgba(255,255,255,0.25);
      transform: scale(1.05);
    }

    .logout-btn {
      margin-top: auto;
      background: linear-gradient(135deg, #ff4b2b, #ff9068);
      border: none;
      color: white;
      padding: 0.8em 1.2em;
      border-radius: 30px;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s ease;
      box-shadow: 0 0 10px rgba(255,107,53,0.4);
    }

    .logout-btn:hover {
      transform: scale(1.07);
      box-shadow: 0 0 25px rgba(255,107,53,0.7);
    }

    /* Main */
    .main-content {
      flex: 1;
      padding: 2em 3em;
      overflow-y: auto;
    }

    .main-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #fff8e1;
      padding: 1em 2em;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 2em;
    }

    .main-header h1 {
      color: #ff7b00;
      font-size: 1.8em;
    }

    .admin-name {
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      padding: 0.6em 1.4em;
      border-radius: 30px;
      color: white;
      font-weight: 600;
      box-shadow: 0 0 10px rgba(255,193,7,0.4);
    }

    /* Table */
    .user-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      animation: fadeInUp 0.8s ease;
    }

    .user-table thead {
      background: linear-gradient(135deg, #ff7b00, #ffd56a);
      color: white;
    }

    .user-table th, .user-table td {
      padding: 1em 1.2em;
      text-align: left;
      border-bottom: 1px solid #f2f2f2;
    }

    .user-table tr:hover {
      background: #fff4e1;
      transform: scale(1.01);
      transition: 0.3s;
    }

    /* Buttons */
    .action-buttons {
      display: flex;
      gap: 0.5em;
    }

    .edit-btn {
      background: linear-gradient(135deg, #4CAF50, #81C784);
      color: white;
      border: none;
      padding: 0.4em 0.9em;
      border-radius: 20px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: 600;
    }

    .edit-btn:hover {
      transform: scale(1.1);
      box-shadow: 0 0 10px rgba(76,175,80,0.6);
    }

    .delete-btn {
      background: linear-gradient(135deg, #ff4b2b, #ff9068);
      color: white;
      border: none;
      padding: 0.4em 0.9em;
      border-radius: 20px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: 600;
    }

    .delete-btn:hover {
      transform: scale(1.1);
      box-shadow: 0 0 10px rgba(255,107,53,0.6);
    }

    /* Animations */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    footer {
      text-align: center;
      margin-top: 3em;
      color: #777;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>🍍 Admin Panel</h2>
    <nav>
      <a href="#users">Manage Users</a>
    </nav>
    <button class="logout-btn" onclick="logoutAdmin()">Logout</button>
  </div>

  <div class="main-content">
    <div class="main-header">
      <h1>User Management</h1>
      <span class="admin-name">🍓 Admin</span>
    </div>

    <table class="user-table" id="users">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Date Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['fullname']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= $row['created_at'] ?? '—' ?></td>
              <td>
                <div class="action-buttons">
                  <button class="edit-btn" onclick="editUser(<?= $row['id'] ?>)">Edit</button>
                  <button class="delete-btn" onclick="deleteUser(<?= $row['id'] ?>)">Delete</button>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5" style="text-align:center; color:#777;">No users found 🍌</td></tr>
        <?php endif; ?>
      </tbody>
    </table>

    <footer>
      © 2025 <b>Fresh Fruits Paradise</b> | Admin Dashboard 🍉
    </footer>
  </div>

  <script>
    function logoutAdmin() {
      if (confirm("Are you sure you want to log out, Admin? 🍊")) {
        window.location.href = 'admin_logout.php';
      }
    }

    function deleteUser(id) {
      if (confirm("Delete this user? This cannot be undone 🍎")) {
        window.location.href = "delete_user.php?id=" + id;
      }
    }

    function editUser(id) {
      window.location.href = "edit_user.php?id=" + id;
    }
  </script>
</body>
</html>
