<header>
  <nav>
    <ul>
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="games.php">Games</a></li>
      <li><a href="support.php">Support</a></li>
      <li><a href="contacts.php">Contacts</a></li>
    </ul>
    <ul class="nav-right">
      <?php
        if (isset($_SESSION['user_id'])) {
          echo '<li><a href="profile.php">Profile</a></li>';
          echo '<li><a href="logout.php">Log out</a></li>';
        } else {
          echo '<li><a href="login.php">Log in</a></li>';
        }
      ?>
    </ul>
  </nav>
</header>