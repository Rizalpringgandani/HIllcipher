
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>Registrasi</h2>
    <form method="post" action="">
        Username: <input type="text" name="username"><br>
        Kata Sandi: <input type="password" name="password"><br>
        <input type="submit" value="Register">
        <p>sudah punya akun?<a href="index.php">Login</a</p>
    </form>
    </div>
</body>
</html>

<?php


include 'hilchiper.php'; // Sertakan fungsi Hill Cipher Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $key = [[2, 1], [3, 4]];
    // Enkripsi kata sandi menggunakan Hill Cipher
    $encrypted_password = hill_cipher($password, $key, "encrypt");

    // Simpan data pengguna ke database
    $conn = mysqli_connect("localhost", "root", "", "login_enkrip"); // Ganti dengan koneksi database yang sesuai

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$encrypted_password')";
    mysqli_query($conn, $query);

    // Alihkan ke halaman login
    header("Location: index.php");
}
?>
