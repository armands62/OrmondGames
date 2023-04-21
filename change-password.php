<?php
    session_start();
    require 'backend/db.php';
    // If the user is not logged in, redirect to the login page
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    // If the user is logged in, display the page
    else {
        // Get the user data from the database
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :user_id');
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $username = $user['username'];
        $email = $user['email'];
        $password = $user['password'];
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
                <li><a href="support.php">Support</a></li>
                <li><a href="contact.php">Contact</a></li>
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
            <!-- Change password section -->
            <h2>Change Password</h2>
            <div class="change-password">
                <form action="change-password.php" method="post">
                    <label for="old-password">Old Password</label>
                    <input type="password" name="old-password" id="old-password">
                    <label for="new-password">New Password</label>
                    <input type="password" name="new-password" id="new-password">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-password" id="confirm-password">
                    <input type="submit" value="Change Password">
                </form>
            </div>
            <?php
                // If the user has submitted the form
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Get the old password from the form
                    $old_password = $_POST['old-password'];
                    // Get the new password from the form
                    $new_password = $_POST['new-password'];
                    // Get the confirm password from the form
                    $confirm_password = $_POST['confirm-password'];
                    // If the old password is correct
                    if (password_verify($old_password, $password)) {
                        // If the new password and confirm password match
                        if ($new_password == $confirm_password) {
                            // Hash the new password
                            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                            // Update the password in the database
                            $stmt = $db->prepare('UPDATE users SET password = :new_password_hash WHERE id = :user_id');
                            $stmt->bindParam(':new_password_hash', $new_password_hash);
                            $stmt->bindParam(':user_id', $_SESSION['user_id']);
                            $stmt->execute();
                            // Redirect to the profile page
                            header('Location: profile.php');
                            exit;
                        }
                        // If the new password and confirm password don't match
                        else {
                            echo '<p class="error">The new password and confirm password do not match.</p>';
                        }
                    }
                    // If the old password is incorrect
                    else {
                        echo '<p class="error">The old password is incorrect.</p>';
                    }
                }
            ?>
    </main>
</body>
</html>
