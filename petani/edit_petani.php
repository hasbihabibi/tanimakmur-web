<?php
require_once '../config/database.php';

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM petani WHERE id_petani='$id'");

$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama_petani'];
    $password = $_POST['password'];
    $telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn,"
    UPDATE petani SET
    nama_petani='$nama',
    password='$password',
    no_telepon='$telepon',
    alamat='$alamat'
    WHERE id_petani='$id'
    ");

    header("Location: petani.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Petani</title>

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

<h2>Edit Data Petani</h2>

<form method="POST">

<label>Nama Petani</label>
<input type="text"
name="nama_petani"
value="<?php echo $row['nama_petani']; ?>">

<label>Password</label>
<input type="text"
name="password"
value="<?php echo $row['password']; ?>">

<label>No Telepon</label>
<input type="text"
name="no_telepon"
value="<?php echo $row['no_telepon']; ?>">

<label>Alamat</label>
<textarea name="alamat"><?php echo $row['alamat']; ?></textarea>

<button type="submit" name="update">
Update
</button>

</form>

</div>

</body>
</html>