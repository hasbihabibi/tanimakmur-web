<?php
require_once '../config/database.php';

$data = mysqli_query($conn,"SELECT * FROM petani");

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>Data Petani</h1>
        <p>Daftar petani yang terdaftar</p>
    </div>

    <div class="card">

        <div class="table-header">

            <a href="tambah_petani.php" class="btn btn-success">
                + Tambah Petani
            </a>

        </div>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row=mysqli_fetch_assoc($data)): ?>

                <tr>

                    <td><?= $row['id_petani']; ?></td>

                    <td><?= $row['nama_petani']; ?></td>

                    <td><?= $row['no_telepon']; ?></td>

                    <td><?= $row['alamat']; ?></td>

                    <td>

                        <a
                            href="edit_petani.php?id=<?= $row['id_petani']; ?>"
                            class="btn btn-warning">
                            Edit
                        </a>

                        <a
                            href="hapus_petani.php?id=<?= $row['id_petani']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                        </a>

                    </td>

                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

<?php include '../includes/footer.php'; ?>