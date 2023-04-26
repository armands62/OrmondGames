<!-- Make a support page which will have a form where the user can send their support request. The form should have a text area for the user to enter their message and a submit button. The form should submit to a file called support.php. -->
<!-- In support.php, check if the user is logged in. If they are not logged in, redirect them to the login page. -->
<!-- If the user is logged in, check if the form has been submitted. If it has, insert the message into the database. -->
<!-- If the message has been inserted, show a success message. -->
<!-- If the message has not been inserted, show an error message. -->
<!-- If the user is not logged in, show an error message. -->
<!-- The form should submit the user_id, the message and the date. -->

<?php
session_start();
// Write the code to insert the message into the database
// If the message has been inserted, show a success message
// If the message has not been inserted, show an error message
// If the user is not logged in, show an error message
// The form should submit the user_id, the message and the date
// If the user is logged in, check if the form has been submitted
// If the form has been submitted, insert the message into the database
// If the user is not logged in, redirect them to the login page
// Write the code now.
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
            <form action="support.php" method="post">
                <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message here"></textarea>
                <input type="submit" value="Send">
            </form>
        </div>
    </main>
    <?php include'footer.php'; ?>
</body>
</html>