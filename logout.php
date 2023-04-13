<!-- Destroys the session and redirects to the index page -->
<?php
 session_start();
 session_destroy();
 header('Location: index.php');
 exit;
 ?>
