<?php
    session_start();
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
        <li><a href="contacts.php" class="active">Contact</a></li>
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
    <div class="contact">
      <h2>Contact Us</h2>
      <img class="logo-contacts" src="images/ormondgames.png" alt="logo">
      <p class='contact'>Thanks for visiting our website. If you have any questions, please contact us at armandsliepa3@gmail.com</p>
    </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>