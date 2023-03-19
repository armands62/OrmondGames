<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Gaming Website - Games</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="games.php" class="active">Games</a></li>
        <li><a href="#">Support</a></li>
        <li><a href="#">Contact</a></li>
        <?php
            if (isset($_SESSION['user_id'])) {
            echo '<li><a href="profile.php">Profile</a></li>';
            echo '<li><a href="logout.php">Log out</a></li>';
            } else {
            echo '<li><a href="login.php">Log in</a></li>';
            }
        ?>
    </nav>
  </header>
  
  <main>
    <h2>Games</h2>
    <div class="games-list">
    <div class="game">
        <a href="#">
        <img src="game1.jpg" alt="Game 1">
        <h3>Game 1</h3>
        <p>Description of Game 1</p>
        </a>
    </div>
    <div class="game">
        <a href="#">
        <img src="game2.jpg" alt="Game 2">
        <h3>Game 2</h3>
        <p>Description of Game 2</p>
        </a>
    </div>
    <div class="game">
        <a href="#">
        <img src="game3.jpg" alt="Game 3">
        <h3>Game 3</h3>
        <p>Description of Game 3</p>
        </a>
    </div>
    </div>
   </main>

    <?php include 'footer.php'; ?>
</body>
</html>