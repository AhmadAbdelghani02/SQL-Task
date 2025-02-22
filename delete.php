<?php
if (isset($_GET['id'])) {
    $pdo = new PDO("mysql:host=localhost;dbname=task;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE Students SET deleted = 1 WHERE student_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $_GET['id']]);

    header("Location: main.php");
    exit();
}
?>
