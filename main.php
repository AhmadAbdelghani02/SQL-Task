<?php
$pdo = new PDO("mysql:host=localhost;dbname=task;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "SELECT * FROM Students WHERE deleted = 0";
$stmt = $pdo->query($sql);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
</head>
<body>
    <h2>Student List</h2>
    <a href="create.php">Add New Student</a>
    <table border="1">
        <tr>
            <th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Major</th><th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['student_id'] ?></td>
            <td><?= htmlspecialchars($student['first_name']) ?></td>
            <td><?= htmlspecialchars($student['last_name']) ?></td>
            <td><?= htmlspecialchars($student['email']) ?></td>
            <td><?= htmlspecialchars($student['major']) ?></td>
            <td>
                <a href="update.php?id=<?= $student['student_id'] ?>">Update</a> | 
                <a href="delete.php?id=<?= $student['student_id'] ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>