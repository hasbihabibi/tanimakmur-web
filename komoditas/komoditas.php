<?php
include 'config/database.php';
$data = mysqli_query($conn, "SELECT * FROM komoditas");
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Komoditas</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial,sans-serif;
    padding:30px;
}

.header{
    background:#3f6f42;
    color:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:15px;
}

.btn{
    background:#3f6f42;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:8px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th{
    background:#3f6f42;
    color:white;
    padding:10px;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

</style>
</head>
<body>

<div class="header">
    <h1>🌾 Data Komoditas</h1>
</div>

<div class="card">

<a href="tambah_komoditas.php" class="btn">
+ Tambah Komoditas
</a>

<table>

<tr>
    <th>ID</th>
    <th>Nama Komoditas</th>
    <th>Deskripsi</th>
    <th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>
    <td><?php echo $row['id_komoditas']; ?></td>
    <td><?php echo $row['nama_komoditas']; ?></td>
    <td><?php echo $row['deskripsi']; ?></td>

    <td>
        <a href="edit_komoditas.php?id=<?php echo $row['id_komoditas']; ?>">
        Edit
        </a>

        |

        <a href="hapus_komoditas.php?id=<?php echo $row['id_komoditas']; ?>">
        Hapus
        </a>
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>