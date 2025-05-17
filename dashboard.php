<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM user_notes WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notes Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body class="bg-light p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Notes</h2>
        <div>
            <a href="add_note.php" class="btn btn-success">Add Note</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <table id="user_notesTable" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($note = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($note['title']) ?></td>
                <td><?= htmlspecialchars($note['category']) ?></td>
                <td><?= htmlspecialchars($note['note_date']) ?></td>
                <td>
                    <a href="edit_note.php?id=<?= $note['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="delete_note.php?id=<?= $note['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
    $('#user_notesTable').DataTable();
});
</script>

</body>
</html>
