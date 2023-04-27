<?php
session_start();
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ormond Games</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <a href='index.php'><img class="logo" src="images/ormondgames.png" alt="logo"></a>
        <li><a href="index.php">Games</a></li>
        <li><a href="support.php">Support</a></li>
        <li><a href="contacts.php">Contact</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="admin.php" class="active">Admin</a></li>
        <li><a href="logout.php">Log out</a></li>
    </nav>
  </header>

  <main>
    <h2>Users</h2>
    <table>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Delete</th>
      </tr>
      <?php
        require_once 'backend/db.php';
        $stmt = $db->prepare('SELECT * FROM users');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
          echo '<tr>';
          echo '<td>' . $user['username'] . '</td>';
          echo '<td>' . $user['email'] . '</td>';
          echo '<td><a href="delete-user.php?id=' . $user['id'] . '">Delete</a></td>';
          echo '</tr>';
        }
      ?>
    </table>
  </main>
</body>
</html>