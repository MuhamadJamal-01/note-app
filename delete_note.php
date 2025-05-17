<?php
session_start();
require '../config/db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$id = $_GET['id'];
$conn->query("DELETE FROM user_notes WHERE id = $id");
header("Location: dashboard.php");
?>
