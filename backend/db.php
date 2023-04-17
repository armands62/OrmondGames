<?php
$db_host = 'localhost';
$db_name = 'ormond_games';
$db_user = 'root';
$db_pass = '';

$db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>