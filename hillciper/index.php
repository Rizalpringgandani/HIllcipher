<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>Login</h2>
    <form method="post" action="">
        Username: <input type="text" name="username"><br>
        Kata Sandi: <input type="password" name="password"><br>
        <input type="submit" value="Login">
        <p>belum punya akun?<a href="registrasi.php">register</a</p>
    </form>
    </div>
</body>
</html>

<?php
// login.php

include 'hilchiper.php'; // Sertakan fungsi Hill Cipher Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data pengguna dari database berdasarkan username
    $conn = mysqli_connect("localhost", "root", "", "login_enkrip"); // Ganti dengan koneksi database yang sesuai

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        $stored_encrypted_password = $user['password'];
        $key = [[2, 1], [3, 4]];
        // Dekripsi kata sandi yang tersimpan menggunakan Hill Cipher
        $decrypted_password = hill_cipher($stored_encrypted_password, $key, "decrypt");
        $hasil = strtolower($decrypted_password);
        if ($password == $hasil) {
            echo "Login berhasil!<br>";
            echo "hasil enkripsi = $stored_encrypted_password<br>";
            echo "hasil dekripsi = $hasil";
        } else {
            echo "Login gagal";
        }
    } else {
        echo "Login gagal. Pengguna tidak ditemukan.";
    }
}
?>
