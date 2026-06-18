<?php
require_once '../config/database.php';

$data = mysqli_query($conn,"SELECT * FROM petani");

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>🌱 Data Petani</h1>
        <p>Daftar petani yang terdaftar</p>
    </div>

    <div class="card">

        <a href="tambah_petani.php" class="btn">
            + Tambah Petani
        </a>

        <table>

            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Alamat</th>
            </tr>

            <?php while($row=mysqli_fetch_assoc($data)): ?>

            <tr>
                <td><?= $row['id_petani']; ?></td>
                <td><?= $row['nama_petani']; ?></td>
                <td><?= $row['no_telepon']; ?></td>
                <td><?= $row['alamat']; ?></td>
            </tr>

            <?php endwhile; ?>

        </table>

    </div>

</div>

<?php include '../includes/footer.php'; ?>