<?php  

    session_start();  

?>  
<!DOCTYPE html>
<html>
  <head>
    <title>Ormond Games</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <!-- Header -->
    <header>
      <nav>
        <ul>
        <img class="logo" src="images/ormondgames.png" alt="logo">
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="games.php">Games</a></li>
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

    <!-- Main content -->
    <main>
      <section id="home">
        <h2>Welcome to Ormond Games!</h2>
        <p>
          Discover the latest and greatest games for all platforms. We offer a
          wide range of games that cater to all types of players, from
          action-packed shooters to brain-teasing puzzles. With our easy-to-use
          website, you can browse and play games with ease.
        </p>
        <p>
          Whether you're a hardcore gamer or just looking to pass the time,
          we've got something for you. So what are you waiting for? Start
          playing today!
        </p>
      </section>
    </main>

    <?php include 'footer.php'; ?>

  </body>
</html>
