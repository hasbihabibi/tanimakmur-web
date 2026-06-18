<?php

require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $id = intval($id); 

    $sql = "DELETE FROM batch_panen WHERE id_batch = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    header("Location: ../index.php");
}
?>