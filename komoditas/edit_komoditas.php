<?php
require_once '../config/database.php';

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM komoditas WHERE id_komoditas='$id'");

$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama_komoditas'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn,"
    UPDATE komoditas SET
    nama_komoditas='$nama',
    deskripsi='$deskripsi'
    WHERE id_komoditas='$id'
    ");

    header("Location: komoditas.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Komoditas</title>

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
}

</style>
</head>
<body>

<div class="card">

<h2>Edit Komoditas</h2>

<form method="POST">

<label>Nama Komoditas</label>
<input type="text"
name="nama_komoditas"
value="<?php echo $row['nama_komoditas']; ?>">

<label>Deskripsi</label>
<textarea name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>

<button type="submit" name="update">
Update
</button>

</form>

</div>

</body>
</html>