<?php
session_start();
require '../config/db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $date = $_POST['note_date'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO user_notes (user_id, title, content, category, note_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $title, $content, $category, $date);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>

<form method="POST">
    Title: <input name="title" required><br>
    Content: <textarea name="content" required></textarea><br>
    Category: <input name="category"><br>
    Date: <input type="date" name="note_date"><br>
    <button type="submit">Save</button>
</form>
