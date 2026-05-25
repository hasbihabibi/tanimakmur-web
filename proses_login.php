<?php
session_start();
include 'koneksi.php';
$email = $_POST['email'];
$password = $_POST['password'];
$query = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");
$data = mysqli_fetch_assoc($query);
if ($data) {
    if ($email == "admin@gmail.com" &&
        $password == "admin123") {

        $_SESSION['login'] = true;
        $_SESSION['nama'] = $data['nama'];
        header("Location: dashboard.php");
        exit;
} else {
        echo "Password salah!";

    }

} else {
    echo "Email tidak ditemukan!";
}
?>