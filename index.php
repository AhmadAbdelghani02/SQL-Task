<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $major = $_POST['major'];
    $enrollment_year = $_POST['enrollment_year'];

    $sql = "INSERT INTO Students (first_name, last_name, email, date_of_birth, gender, major, enrollment_year) 
            VALUES (:first_name, :last_name, :email, :date_of_birth, :gender, :major, :enrollment_year)";

    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':date_of_birth' => $date_of_birth,
            ':gender' => $gender,
            ':major' => $major,
            ':enrollment_year' => $enrollment_year
        ]);
        echo "<p style='color: green;'>Student added successfully!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <h2>Student Registration</h2>
    <form method="POST">
        <label>First Name:</label>
        <input type="text" name="first_name" required><br><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Date of Birth:</label>
        <input type="date" name="date_of_birth" required><br><br>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <label>Major:</label>
        <input type="text" name="major" required><br><br>

        <label>Enrollment Year:</label>
        <input type="number" name="enrollment_year" min="2000" max="2099" required><br><br>

        <button type="submit">Add Student</button>
    </form>
</body>
</html>
