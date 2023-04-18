<?php
require_once 'backend/db.php';

// Check if the registration form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate the inputs
  $errors = array();
  if (empty($username)) {
    $errors['username'] = 'Please enter a username.';
  }
  if (empty($email)) {
    $errors['email'] = 'Please enter an email address.';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
  }
  if (empty($password)) {
    $errors['password'] = 'Please enter a password.';
  }
  if ($password !== $confirm_password) {
    $errors['confirm_password'] = 'Passwords do not match.';
  }

  // Check if the username or email is already taken
  $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE username = ? OR email = ?');
  $stmt->execute(array($username, $email));
  $count = $stmt->fetchColumn();
  if ($count > 0) {
    if ($count['username'] > 0) {
      $errors['username'] = 'Username is already taken.';
    }
    if ($count['email'] > 0) {
      $errors['email'] = 'Email is already taken.';
    }
  }

  // If there are no errors, create the user account and redirect to the login page and create a new entry in the profile table

  if (empty($errors)) {
    $stmt = $db->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->execute(array($username, $email, password_hash($password, PASSWORD_DEFAULT)));
    $stmt = $db->prepare('INSERT INTO profiles (user_id) VALUES (?)');
    $stmt->execute(array($db->lastInsertId()));
    header('Location: login.php');
    exit;
  }
}
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
        <li><a href="index.php">Games</a></li>
        <li><a href="#">Support</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="login.php" class="active">Log in</a></li>
    </nav>
  </header>

  <main>
    <h2>Register</h2>
    <form action="register.php" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password">
      </div>
      <button type="submit">Register</button>
    </form>
  </main>

  <?php include 'footer.php'; ?>

</body>
</html>
