<?php
// Delete user function

if (isset($_GET['id'])) {
  require_once 'backend/db.php';
  $stmt = $db->prepare('DELETE FROM profiles WHERE user_id = :id');
  $stmt->execute(['id' => $_GET['id']]);
}

if (isset($_GET['id'])) {
    require_once 'backend/db.php';
    $stmt = $db->prepare('DELETE FROM comments WHERE user_id = :id');
    $stmt->execute(['id' => $_GET['id']]);
}

  if (isset($_GET['id'])) {
    require_once 'backend/db.php';
    $stmt = $db->prepare('DELETE FROM messages WHERE user_id = :id');
    $stmt->execute(['id' => $_GET['id']]);
}

if (isset($_GET['id'])) {
    require_once 'backend/db.php';
    $stmt = $db->prepare('DELETE FROM users WHERE id = :id');
    $stmt->execute(['id' => $_GET['id']]);
    header('Location: admin.php');
  }