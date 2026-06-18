<?php
require_once '../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM komoditas
WHERE id_komoditas='$id'");

header("Location: komoditas.php");
exit;
?>