<?php
    session_start();
    // Connect to the database
    require_once 'backend/db.php';
    $user_id = $_SESSION['user_id'];

    // The user data from the database

    $stmt = $db->prepare('SELECT username, email FROM users WHERE id = :user_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $user['username'];
    $email = $user['email'];

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
        <li><a href="support.php">Support</a></li>
        <li><a href="contacts.php">Contact</a></li>
        <li><a href="profile.php" class="active">Profile</a></li>
        <?php
        if ($_SESSION['admin'] == 1) {
                echo '<li><a href="admin.php">Admin</a></li>';
              }
        ?>
        <li><a href="logout.php">Log out</a></li>
            
    </nav>
  </header>
  <main>
        <section id="profile-details">
        <!-- User information section -->
        <h2>User Information</h2>
        <div class="profile-info">
            <p> <strong>Username:</strong> <?php echo $username; ?></p>
            <p> <strong>Email:</strong> <?php echo $email; ?></p>
            <!-- If the user has a bio, display it -->
            <?php
                $stmt = $db->prepare('SELECT bio FROM profiles WHERE user_id = :user_id');
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                $profile = $stmt->fetch(PDO::FETCH_ASSOC);
                $bio = $profile['bio'];
                if ($bio) {
                    echo '<p><strong>Bio:</strong> ' . $bio . '</p>';
                }
            ?>
            <h3>Update Bio: </h3>
            <form action="#" method="post">
                <textarea name="bio" id="profile-bio" cols="30" rows="10"></textarea>
                <button type="submit">Save Bio</button>
            </form>
            <!-- If submitted, save the bio data to the profile table -->
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $bio = $_POST['bio'];
                    $stmt = $db->prepare('UPDATE profiles SET bio = :bio WHERE user_id = :user_id');
                    $stmt->bindParam(':bio', $bio);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->execute();
                    header('Location: profile.php');
                }
            ?>
            <h3><a href="change-password.php">Change Password</a></h3>
            <h3><a href="change-email.php">Change Email</a></h3>
            <h3><a href="change-username.php">Change Username</a></h3>
            <h3><a href="delete-account.php">Delete Account</a></h3>
        </div>
        
        <section id="profile-privacy">
            <h2>Privacy Settings</h2>
            <form action="#" method="post">
                <div class="form-group">
                <label for="private-profile">Make my profile private</label>
                    <input type="checkbox" name="private" id="private-profile">
                </div>
                <button type="submit">Save Settings</button>
            </form>
        </section>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>