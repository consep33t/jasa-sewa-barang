<?php
session_start(); // Mulai sesi

$servername = "localhost";
$username = "root";
$password = "";
$database = "jasa_sewa_barang _elektronik"; // Perhatikan bahwa spasi dalam nama database dihapus

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Mengambil data dari formulir login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengecek kredensial dalam database
    $stmt = $conn->prepare("SELECT username, password, user_type FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($dbUsername, $dbPassword, $user_type);
    $stmt->fetch();

    if (password_verify($password, $dbPassword)) { // Verifikasi kata sandi
        // Login berhasil
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $user_type;

        if ($user_type == "admin") {
            header("Location: admin_dashboard.php"); // Ganti dengan nama file admin dashboard yang sesuai
        } else {
            header("Location: dashboard.php"); // Ganti dengan nama file dashboard pengguna yang sesuai
        }
    } else {
        // Login gagal
        echo "Login gagal. Username atau password salah.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/login.css">
    <title>login form</title>
</head>
<body>
    <h2>Formulir login</h2>
    <div class="form" >
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            
            <input type="submit" value="Login">
            <a href="dashboard.php">back to dashboard</a>
    </div>
</body>
</html>