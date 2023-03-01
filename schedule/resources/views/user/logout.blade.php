<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
  header('Location: login.php');
  exit();
}

$_SESSION = array();
session_destroy();
header('Location: login.php');

?>