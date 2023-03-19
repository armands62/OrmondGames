<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ormond Games</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../games.php" class="active">Games</a></li>
        <li><a href="#">Support</a></li>
        <li><a href="#">Contact</a></li>
        <?php
            if (isset($_SESSION['user_id'])) {
            echo '<li><a href="../profile.php">Profile</a></li>';
            echo '<li><a href="../logout.php">Log out</a></li>';
            } else {
            echo '<li><a href="../login.php">Log in</a></li>';
            }
        ?>
    </nav>
  </header>

<?php include '../footer.php'; ?>
</body>
</html>
   


