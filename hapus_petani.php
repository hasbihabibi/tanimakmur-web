<?php
include 'config/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM petani
        WHERE id_petani='$id'";

if($conn->query($sql)){
    header("Location: petani.php");
    exit;
}else{
    echo "Data gagal dihapus";
}
?>