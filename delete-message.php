<?php
// Only allow admins to access this page
session_start();
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
  header('Location: index.php');
  exit;
}
// Delete message function
if (isset($_GET['id'])) {
  require_once 'backend/db.php';
  $stmt = $db->prepare('DELETE FROM messages WHERE id = :id');
  $stmt->execute(['id' => $_GET['id']]);
  header('Location: support-messages.php');
}
?>