<?php
require_once '../config/database.php';

if(isset($_POST['simpan'])){

    $id = $_POST['id_komoditas'];
    $nama = $_POST['nama_komoditas'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "INSERT INTO komoditas
    (id_komoditas,nama_komoditas,deskripsi)
    VALUES
    ('$id','$nama','$deskripsi')";

    if($conn->query($sql)){
        header("Location: komoditas.php");
        exit;
    }else{
        echo "Gagal Menyimpan Data";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Komoditas</title>

<style>

body{
    background:#f4f6f9;
    font-family:Arial,sans-serif;
}

.card{
    width:500px;
    margin:50px auto;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

h2{
    color:#3f6f42;
    margin-bottom:20px;
}

input, textarea{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:8px;
}

button{
    background:#3f6f42;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:8px;
    cursor:pointer;
}

</style>

</head>
<body>

<div class="card">

<h2>Tambah Komoditas</h2>

<form method="POST">

<label>ID Komoditas</label>
<input type="text" name="id_komoditas" placeholder="KMD-004" required>

<label>Nama Komoditas</label>
<input type="text" name="nama_komoditas" required>

<label>Deskripsi</label>
<textarea name="deskripsi"></textarea>

<button type="submit" name="simpan">
Simpan
</button>

</form>

</div>

</body>
</html>