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
      echo '<div class="game-info">';
      echo '<h2>' . $game['name'] . '</h2>';
      echo '</div>';
      echo '<div class="game-display">';
      echo '<div><script src="' . $game['url'] . '"></script></div>';
      echo '</div>';
    ?>
    <div class="comments">
      <h2>Comments</h2>
      <?php
        if (isset($_SESSION['user_id'])) {
          echo '<form class="add-comment" action="game.php" method="post">';
          echo '<input type="hidden" name="game_id" value="' . $_GET['id'] . '">';
          echo '<h3>Add a comment</h3>';
          echo '<textarea name="comment" id="add-comment" rows="10" required></textarea>';
          echo '<input type="submit" value="Add comment">';
          echo '</form>';
        } else {
          echo '<p>You must be logged in to add a comment.</p>';
        }
      ?>
      <?php
        if(isset($_POST['comment'])) {
          require_once 'backend/db.php';
          $stmt = $db->prepare('INSERT INTO comments (user_id, game_id, comment, created_at) VALUES (:user_id, :game_id, :comment, :created_at)');
          $stmt->execute([
              'user_id' => $_SESSION['user_id'],
              'game_id' => $_POST['game_id'],
              'comment' => $_POST['comment'],
              'created_at' => date('Y-m-d H:i:s')
          ]);
          header('Location: game.php?id=' . $_POST['game_id']);
        }
      ?>
      <?php
        require_once 'backend/db.php';
        $stmt = $db->prepare('SELECT * FROM comments INNER JOIN users ON comments.user_id = users.id WHERE game_id = :game_id');
        $stmt->execute(['game_id' => $_GET['id']]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($comments as $comment) {
          echo '<div class="comment">';
          echo '<h3>' . $comment['username'] . '</h3>';
          echo '<p>' . $comment['comment'] . '</p>';
          echo '<p>' . $comment['created_at'] . '</p>';
          echo '</div>';
        }
      ?>
    </div>
   </main>
    <?php include 'footer.php'; ?>
</body>
</html>