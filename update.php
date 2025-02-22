<?php
$pdo = new PDO("mysql:host=localhost;dbname=task;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE Students SET first_name = :first_name, last_name = :last_name, email = :email, 
            major = :major WHERE student_id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':email' => $_POST['email'],
        ':major' => $_POST['major'],
        ':id' => $_POST['id']
    ]);

    header("Location: main.php");
    exit();
} else {
    $stmt = $pdo->prepare("SELECT * FROM Students WHERE student_id = :id");
    $stmt->execute([':id' => $_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
</head>
<body>
    <h2>Update Student</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $student['student_id'] ?>">
        <input type="text" name="first_name" value="<?= $student['first_name'] ?>" required><br>
        <input type="text" name="last_name" value="<?= $student['last_name'] ?>" required><br>
        <input type="email" name="email" value="<?= $student['email'] ?>" required><br>
        <input type="text" name="major" value="<?= $student['major'] ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
