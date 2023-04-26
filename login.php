<?php
if (isset($_POST['submit'])) {
    // Connect to the database
    require_once 'backend/db.php';

    // Get the form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate the form data
    if (empty($username) || empty($password)) {
        $error = 'Please enter a username and password.';
    } else {
        // Check if the user exists in the database
        $stmt = $db->prepare('SELECT id, password, is_admin FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Start the session and set session variables
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = $user['is_admin'];
            
            // Redirect to the profile page
            header('Location: profile.php');
            exit;
        } else {
            // Show error message
            $error = 'Invalid username or password.';
        }
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
    <h2>Log In</h2>
    <form action="login.php" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
      </div>
      <button type="submit" name="submit">Log In</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
    <p>Forgot your password? <a href="forgot_password.php">Reset it here</a></p>
  </main>

  <?php include 'footer.php'; ?>

</body>
</html>