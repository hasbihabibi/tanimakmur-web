<?php
require_once '../config/database.php';

$data = mysqli_query($conn,"SELECT * FROM komoditas");

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>Data Komoditas</h1>
        <p>Daftar komoditas yang tersedia</p>
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
                <th width="180">Aksi</th>
            </tr>

            <?php while($row=mysqli_fetch_assoc($data)): ?>

            <tr>
                <td><?= $row['id_komoditas']; ?></td>
                <td><?= $row['nama_komoditas']; ?></td>
                <td><?= $row['deskripsi']; ?></td>

                <td>

                    <a
                    href="edit_komoditas.php?id=<?= $row['id_komoditas']; ?>"
                    class="btn-edit">
                    Edit
                    </a>

                    <a
                    href="hapus_komoditas.php?id=<?= $row['id_komoditas']; ?>"
                    class="btn-delete"
                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                    Hapus
                    </a>

                </td>
            </tr>

            <?php endwhile; ?>

        </table>

    </div>

</div>

<?php include '../includes/footer.php'; ?>