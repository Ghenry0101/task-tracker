<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'tasktracker');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Logika untuk menambahkan data Guru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Periksa apakah email sudah ada
    $checkQuery = "SELECT * FROM Guru WHERE Email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Email sudah terdaftar
        echo "Error: Email sudah terdaftar!";
    } else {
        // Tambahkan data jika email belum ada
        $query = "INSERT INTO Guru (Name, Email) VALUES ('$name', '$email')";
        if ($conn->query($query)) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Error saat menambahkan data: " . $conn->error;
        }
    }
}

// Tutup koneksi
$conn->close();
?>