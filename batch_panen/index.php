<?php
require_once '../config/database.php';

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>🌾 Batch Panen</h1>
        <p>Data hasil panen petani yang telah tercatat</p>
    </div>

    <div class="card">

        <a href="tambah_batch.php" class="btn">
            + Tambah Batch
        </a>

        <table>

            <thead>
                <tr>
                    <th>ID Batch</th>
                    <th>Tanggal Panen</th>
                    <th>Petani</th>
                    <th>Komoditas</th>
                    <th>Grade</th>
                    <th>Kuantitas</th>
                    <th>Harga/Kg</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php

            $sql = "
            SELECT
                b.id_batch,
                b.tanggal_panen,
                b.kuantitas_kg,
                b.grade_panen,
                b.harga_per_kg_saat_ini,
                p.nama_petani,
                k.nama_komoditas

            FROM batch_panen b

            LEFT JOIN petani p
            ON b.id_petani = p.id_petani

            LEFT JOIN komoditas k
            ON b.id_komoditas = k.id_komoditas

            ORDER BY b.tanggal_panen DESC
            ";

            $result = $conn->query($sql);

            if($result->num_rows > 0):

                while($row = $result->fetch_assoc()):
            ?>

                <tr>

                    <td>
                        BP-<?= $row['id_batch']; ?>
                    </td>

                    <td>
                        <?= $row['tanggal_panen']; ?>
                    </td>

                    <td>
                        <?= $row['nama_petani']; ?>
                    </td>

                    <td>
                        <?= $row['nama_komoditas']; ?>
                    </td>

                    <td>
                        <span class="badge">
                            <?= $row['grade_panen']; ?>
                        </span>
                    </td>

                    <td>
                        <?= number_format($row['kuantitas_kg'],0,',','.'); ?>
                        Kg
                    </td>

                    <td>
                        Rp
                        <?= number_format($row['harga_per_kg_saat_ini'],0,',','.'); ?>
                    </td>

                    <td>

                        <a
                        href="actions/delete_panen.php?id=<?= $row['id_batch']; ?>"
                        class="btn-delete"
                        onclick="return confirm('Hapus data ini?')">
                            Hapus
                        </a>

                    </td>

                </tr>

            <?php
                endwhile;

            else:
            ?>

                <tr>
                    <td colspan="8" class="text-center">
                        Data batch panen belum tersedia
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php include '../includes/footer.php'; ?>