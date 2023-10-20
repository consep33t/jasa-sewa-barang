<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "jasa_sewa_barang _elektronik";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($email) || empty($password)) {
        echo "Semua field harus diisi.";
    } else {
        // Pengamanan kata sandi
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Gunakan pernyataan pra-terkompilasi untuk mencegah SQL Injection
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)");
        $user_type = "user";
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $user_type);

        if ($stmt->execute()) {
            header("Location: login.php");
            echo "Pendaftaran berhasil!";
        } else {
            echo "Pendaftaran gagal: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    
    <h2>Formulir Pendaftaran</h2>
    <form method="post" action="register.php">
        <label for="username">Nama:</label>
        <input type="text" name="username" id="username" placeholder="Username" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Email" required><br>

        <label for="password">Kata Sandi:</label>
        <input type="password" name="password" id="password" placeholder="Kata Sandi" required><br>

        <input type="submit" value="Daftar">
        <a href="dashboard.php">dash</a>
    </form>
</body>
</html>
