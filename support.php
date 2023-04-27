<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if (isset($_POST['message'])) {
        require_once 'backend/db.php';
        $message = $_POST['message'];
        $user_id = $_SESSION['user_id'];
        $created_at = date('Y-m-d H:i:s');
        $stmt = $db->prepare('INSERT INTO messages (user_id, message, created_at) VALUES (:user_id, :message, :created_at)');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':created_at', $created_at);
        if ($stmt->execute()) {
            echo 'Message sent successfully.';
        } else {
            echo 'Message not sent.';
        }
    }
} else {
    header('Location: login.php');
    exit;
}
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
                <li><a href="support.php" class="active">Support</a></li>
                <li><a href="contacts.php">Contact</a></li>
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
            </ul>
        </nav>
    </header>
    <main>
        <div class="support">
            <h2>Support</h2>
            <h3>Send us your complaints here!</h3>
            <h3>We will send you an email responding to your message as quick as we can!</h3>
            <form action="support.php" method="post">
                <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message here"></textarea>
                <input type="submit" value="Send">
            </form>
        </div>
    </main>
    <?php include'footer.php'; ?>
</body>
</html>