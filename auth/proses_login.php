<?php
session_start();
require_once '../config/database.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE email='$email'"
);

$data = mysqli_fetch_assoc($query);

if($data){

    if($password == $data['password']){

        $_SESSION['login'] = true;
        $_SESSION['nama'] = $data['nama'];

        header("Location: ../dashboard/index.php");
        exit;

    } else {

        echo "Password salah!";

    }

} else {

    echo "Email tidak ditemukan!";

}
?>