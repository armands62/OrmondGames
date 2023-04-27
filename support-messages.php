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
  <title>Support Messages</title>
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
    <section id="support-messages">
      <h2>Support Messages</h2>
      <div class="support-messages">
        <?php
          // Connect to the database
          require_once 'backend/db.php';
          // Get all the messages from the database
          $stmt = $db->prepare('SELECT * FROM messages ORDER BY created_at ASC');
          $stmt->execute();
          $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
          // Loop through the messages and display them
          foreach ($messages as $message) {
            $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
            $stmt->bindValue(':id', $message['user_id']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<div class="message">';
            echo '<p><strong>From:</strong> ' . $user['username'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $user['email'] . '</p>';
            echo '<p><strong>Message:</strong> ' . $message['message'] . '</p>';
            echo '<p><strong>Date:</strong> ' . $message['created_at'] . '</p>';
            echo '<p><strong>ID:</strong> ' . $message['id'] . '</p>';
            echo '<a href="delete-message.php?id=' . $message['id'] . '">Delete</a>';
            echo '</div>';
          }
        ?>
      </div>
    </section>
  </main>
</body>
</html>