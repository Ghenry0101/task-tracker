<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'tasktracker');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah Data
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $checkQuery = "SELECT * FROM Guru WHERE Email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Error: Email sudah terdaftar!";
    } else {
        $query = "INSERT INTO Guru (Name, Email) VALUES ('$name', '$email')";
        if ($conn->query($query)) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Hapus Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Guru WHERE TeacherID = $id";
    if ($conn->query($query)) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Edit Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "UPDATE Guru SET Name = '$name', Email = '$email' WHERE TeacherID = $id";
    if ($conn->query($query)) {
        echo "Data berhasil diperbarui!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil Semua Data
$query = "SELECT * FROM Guru";
$result = $conn->query($query);

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Tracker</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Task Tracker</h1>

    <!-- Form Tambah Data -->
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Nama Guru" required>
        <input type="email" name="email" placeholder="Email Guru" required>
        <button type="submit" name="add">Tambah Data</button>
    </form>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['TeacherID'] ?></td>
                    <td><?= $row['Name'] ?></td>
                    <td><?= $row['Email'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['TeacherID'] ?>">Edit</a>
                        <a href="?delete=<?= $row['TeacherID'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

