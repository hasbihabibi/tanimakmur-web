<?php
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM batch_panen WHERE id_batch = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // DIUBAH: Menghapus ../ agar tetap di folder batch_panen
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }

} else {
    // DIUBAH: Menghapus ../ agar tetap di folder batch_panen
    header("Location: index.php");
    exit();
}
?>