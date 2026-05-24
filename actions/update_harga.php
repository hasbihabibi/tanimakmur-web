<?php
// actions/update_harga.php
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id_batch']);
    $harga_baru = $conn->real_escape_string($_POST['harga_baru']);

    $sql = "UPDATE batch_panen SET harga_per_kg_saat_ini = '$harga_baru' WHERE id_batch = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Gagal memperbarui harga: " . $conn->error;
    }
}
?>