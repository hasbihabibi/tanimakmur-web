<?php
include 'config/database.php';

$data = mysqli_query($conn, "SELECT * FROM petani");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Petani</title>

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial, sans-serif;
    }

    body{
        background:#f4f6f9;
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
        border-radius:15px;
        padding:25px;
        box-shadow:0 5px 15px rgba(0,0,0,0.1);
    }

    .btn{
        background:#3f6f42;
        color:white;
        text-decoration:none;
        padding:10px 15px;
        border-radius:8px;
        display:inline-block;
        margin-bottom:20px;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    table th{
        background:#3f6f42;
        color:white;
        padding:12px;
    }

    table td{
        padding:12px;
        border-bottom:1px solid #ddd;
        text-align:center;
    }

    .edit{
        color:#007bff;
        text-decoration:none;
        font-weight:bold;
    }

    .hapus{
        color:red;
        text-decoration:none;
        font-weight:bold;
    }

    </style>

</head>
<body>

<div class="header">
    <h1>🌱 Data Petani</h1>
    <p>Sistem Informasi Logistik Tani Makmur</p>
</div>

<div class="card">

    <a href="tambah_petani.php" class="btn">
        + Tambah Petani
    </a>

    <table>

        <tr>
            <th>ID Petani</th>
            <th>Nama Petani</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)) { ?>

        <tr>
            <td><?php echo $row['id_petani']; ?></td>
            <td><?php echo $row['nama_petani']; ?></td>
            <td><?php echo $row['no_telepon']; ?></td>
            <td><?php echo $row['alamat']; ?></td>

            <td>
                <a class="edit"
                href="edit_petani.php?id=<?php echo $row['id_petani']; ?>">
                Edit
                </a>

                |

                <a class="hapus"
                onclick="return confirm('Yakin ingin menghapus data ini?')"
                href="hapus_petani.php?id=<?php echo $row['id_petani']; ?>">
                Hapus
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>