<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'tasktracker');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Guru WHERE TeacherID = $id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "UPDATE Guru SET Name = '$name', Email = '$email' WHERE TeacherID = $id";
    if ($conn->query($query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data Guru</h1>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $row['TeacherID'] ?>">
        <input type="text" name="name" value="<?= $row['Name'] ?>" required>
        <input type="email" name="email" value="<?= $row['Email'] ?>" required>
        <button type="submit" name="update">Update Data</button>
    </form>
</body>
</html>
