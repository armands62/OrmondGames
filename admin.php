<?php
// Connect to the database
require_once 'backend/db.php';
// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $game_name = trim($_POST['game_name']);
    $url = trim($_POST['url']);
    // Validate the form data
    if (empty($game_name) || empty($url)) {
        $error = 'Please enter a game name and url.';
    } else {
        // Check if the game already exists in the database
        $stmt = $db->prepare('SELECT id FROM games WHERE name = :game_name');
        $stmt->bindParam(':game_name', $game_name);
        $stmt->execute();
        $game = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($game) {
            $error = 'That game already exists.';
        } else {
            // Insert the game into the database
            $stmt = $db->prepare('INSERT INTO games (name, url) VALUES (:game_name, :url)');
            $stmt->bindParam(':game_name', $game_name);
            $stmt->bindParam(':url', $url);
            $stmt->execute();
            // Redirect to the games page
            header('Location: index.php');
            exit;
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
        <img class="logo" src="images/ormondgames.png" alt="logo">
        <li><a href="index.php">Games</a></li>
        <li><a href="support.php">Support</a></li>
        <li><a href="contacts.php">Contact</a></li>
        <li><a href="admin.php" class="active">Admin</a></li>
        <li><a href="logout.php">Log out</a></li>
    </nav>
  </header>

  <main>
    <h2>Add Game</h2>
    <form action="admin.php" method="post">
      <label for="game_name">Game Name</label>
      <input type="text" name="game_name" id="game_name">
      <label for="url">URL</label>
      <input type="text" name="url" id="url">
      <input type="submit" name="submit" value="Add Game">
    </form>
  </main>

  <footer>
    <p>Ormond Games &copy; 2020</p>
  </footer>