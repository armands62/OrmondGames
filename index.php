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
        <img class="logo" src="images/ormondgames.png" alt="logo">
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
    <h2>Games</h2>
    <?php
      require_once 'backend/db.php';
      $stmt = $db->prepare('SELECT * FROM games');
      $stmt->execute();
      $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($games as $game) {
        echo '<div class="game">';
        echo '<h3>' . $game['name'] . '</h3>';
        echo '<img src="' . $game['image'] . '" alt="' . $game['name'] . '">';
        echo '<a href="game.php?id=' . $game['id'] . '">Play</a>';
        echo '</div>';
      }
    ?>
   </main>

    <?php include 'footer.php'; ?>
</body>
</html>