<?php
// actions/delete_panen.php
require_once '../config/database.php'; // Pakai ../ karena posisi filenya sekarang di dalam folder actions

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Keamanan dasar agar ID selalu berupa angka
    $id = intval($id); 

    // Eksekusi hapus
    $sql = "DELETE FROM batch_panen WHERE id_batch = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php"); // Tendang kembali ke dasbor
        exit();
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    header("Location: ../index.php");
}
?>