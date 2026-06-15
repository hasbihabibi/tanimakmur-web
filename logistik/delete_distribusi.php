<?php
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id_batch = $conn->real_escape_string($_GET['id']);

    // Mengosongkan data pengiriman (reset status menjadi 'Belum Dikirim')
    $stmt = $conn->prepare("UPDATE batch_panen SET nama_driver = NULL, plat_nomor = NULL, tanggal_kirim = NULL, tanggal_sampai = NULL, status_distribusi = 'Belum Dikirim' WHERE id_batch = ?");
    $stmt->bind_param("i", $id_batch);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal membatalkan pengiriman: " . $conn->error;
    }
    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}
?>