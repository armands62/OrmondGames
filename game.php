<?php
  session_start();
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ormond Games</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <a href='index.php'><img class="logo" src="images/ormondgames.png" alt="logo"></a>
        <li><a href="index.php" class="active">Games</a></li>
        <li><a href="support.php">Support</a></li>
        <li><a href="#">Contact</a></li>
        <?php
            if (isset($_SESSION['user_id'])) {
            echo '<li><a href="profile.php">Profile</a></li>';
              if ($_SESSION['admin'] == 1) {
                echo '<li><a href="admin.php">Admin</a></li>';
              }
            echo '<li><a href="logout.php">Log out</a></li>';

            } else {
            echo '<li><a href="login.php">Log in</a></li>';
            }
        ?>
    </nav>
  </header>

  <main>
    <?php
      require_once 'backend/db.php';
      $stmt = $db->prepare('SELECT * FROM games WHERE id = :id');
      $stmt->execute(['id' => $_GET['id']]);
      $game = $stmt->fetch(PDO::FETCH_ASSOC);
      echo '<h2>' . $game['name'] . '</h2>';
      echo '<div><script src="' . $game['url'] . '"></script></div>';
    ?>
   </main>
    <?php include 'footer.php'; ?>
</body>
</html>