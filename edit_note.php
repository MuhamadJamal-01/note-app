<?php
session_start();
require '../config/db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM user_notes WHERE id = $id");
$note = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $date = $_POST['note_date'];

    $stmt = $conn->prepare("UPDATE user_notes SET title=?, content=?, category=?, note_date=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $content, $category, $date, $id);
    $stmt->execute();
    header("Location: dashboard.php");
}
?>

<form method="POST">
    Title: <input name="title" value="<?= $note['title'] ?>" required><br>
    Content: <textarea name="content"><?= $note['content'] ?></textarea><br>
    Category: <input name="category" value="<?= $note['category'] ?>"><br>
    Date: <input type="date" name="note_date" value="<?= $note['note_date'] ?>"><br>
    <button type="submit">Update</button>
</form>
