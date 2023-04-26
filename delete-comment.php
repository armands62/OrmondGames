<?php 
// Delete comment function
if (isset($_POST['comment_id'])) {
  require_once 'backend/db.php';
  $stmt = $db->prepare('DELETE FROM comments WHERE id = :id');
  $stmt->execute(['id' => $_POST['comment_id']]);
  header('Location: game.php?id=' . $_POST['game']);
}
?>

