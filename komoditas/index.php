<?php
require_once '../config/database.php';

$data = mysqli_query($conn,"SELECT * FROM komoditas");

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>🌾 Data Komoditas</h1>
        <p>Daftar komoditas yang tersedia</p>
    </div>

    <div class="card">

        <a href="tambah_komoditas.php" class="btn">
            + Tambah Komoditas
        </a>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Komoditas</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($data)): ?>

                <tr>
                    <td><?= $row['id_komoditas']; ?></td>
                    <td><?= $row['nama_komoditas']; ?></td>
                    <td><?= $row['deskripsi']; ?></td>
                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

<?php include '../includes/footer.php'; ?>