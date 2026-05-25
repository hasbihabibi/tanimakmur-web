<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<h1>
    Selamat Datang
    <?= $_SESSION['nama']; ?>
</h1>
<a href="logout.php">Logout</a>