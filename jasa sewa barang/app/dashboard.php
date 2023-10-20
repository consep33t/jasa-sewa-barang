<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/dashboard.css">
    <title>Jasa sewa barang elektronik</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#" class="icon">Jasa Sewa Barang</a></li>
            <li><a href="#">hanphone</a></li>
            <li><a href="#">laptop</a></li>
        </ul>
<?php
session_start();

if (isset($_SESSION['username'])) {
    // Pengguna sudah login
    echo $_SESSION['username'] . " " .'<div class="btn-logout"><a href="javascript:logout()">Logout</a></div>';
} else {
    // Pengguna belum login
    echo '<div class="btn-login"><a href="login.php">Login</a> | <a href="register.php">Pendaftaran</a></div>';
}
?>
    </nav>
<section class="content"> 
    <div class="search_bar">
        <form action="" method="post">
            <input type="text" placeholder="Cari produk.." name="keyword">
            <button type="submit"><i class="fa fa-search">search</i></button>
    </div>
</section>

    <script>
        function logout() {
            // Tampilkan kotak dialog konfirmasi
            var logoutConfirmed = confirm("Apakah Anda yakin ingin logout?");
            if (logoutConfirmed) {
                // Jika pengguna menekan OK, maka arahkan ke halaman logout
                window.location.href = "logout.php";
            }
        }
    </script>
</body>
</html>
