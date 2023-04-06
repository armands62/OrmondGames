<!-- BEGIN support -->
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
            <li><a href="index.php">Games</a></li>
            <li><a href="support.php" class="active">Support</a></li>
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
        <h2>Support</h2>
        <div class="support">
            <p>For support, please contact us at <a href="mailto: armandsliepa3@gmail.com"> this email address</a>.</p>
    </main>