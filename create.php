<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = new PDO("mysql:host=localhost;dbname=task;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO Students (first_name, last_name, email, date_of_birth, gender, major, enrollment_year) 
            VALUES (:first_name, :last_name, :email, :date_of_birth, :gender, :major, :enrollment_year)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':email' => $_POST['email'],
        ':date_of_birth' => $_POST['date_of_birth'],
        ':gender' => $_POST['gender'],
        ':major' => $_POST['major'],
        ':enrollment_year' => $_POST['enrollment_year']
    ]);

    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h2>Add Student</h2>
    <form method="POST">
        <input type="text" name="first_name" placeholder="First Name" required><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="date" name="date_of_birth" required><br>
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>
        <input type="text" name="major" placeholder="Major" required><br>
        <input type="number" name="enrollment_year" placeholder="Enrollment Year" required><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
