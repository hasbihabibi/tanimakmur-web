<?php
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id_batch     = $conn->real_escape_string($_GET['id']);
    $tgl_sekarang = date('Y-m-d');

    // Mengubah status_distribusi langsung di tabel batch_panen
    $stmt = $conn->prepare("UPDATE batch_panen SET status_distribusi = 'Sampai Tujuan', tanggal_sampai = ? WHERE id_batch = ?");
    $stmt->bind_param("si", $tgl_sekarang, $id_batch);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal mengupdate status: " . $conn->error;
    }
    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}
?>