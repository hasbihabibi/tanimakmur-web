<?php
include 'config/database.php';

if(isset($_POST['simpan'])){

    $id = $_POST['id_petani'];
    $nama = $_POST['nama_petani'];
    $password = $_POST['password'];
    $telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO petani
    (id_petani,nama_petani,password,no_telepon,alamat)
    VALUES
    ('$id','$nama','$password','$telepon','$alamat')";

    if($conn->query($sql)){
        header("Location: petani.php");
        exit;
    }else{
        echo "Gagal Menyimpan Data";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Petani</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card{
    width:500px;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

h2{
    text-align:center;
    color:#3f6f42;
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}

input, textarea{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:8px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    background:#3f6f42;
    color:white;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#2f5532;
}

</style>
</head>
<body>

<div class="card">

<h2>Tambah Data Petani</h2>

<form method="POST">

<label>ID Petani</label>
<input type="text" name="id_petani" placeholder="PTN-003" required>

<label>Nama Petani</label>
<input type="text" name="nama_petani" required>

<label>Password</label>
<input type="text" name="password" required>

<label>No Telepon</label>
<input type="text" name="no_telepon">

<label>Alamat</label>
<textarea name="alamat"></textarea>

<button type="submit" name="simpan">
Simpan
</button>

</form>

</div>

</body>
</html>