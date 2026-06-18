<?php
require_once '../config/database.php';

$totalPanen = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT SUM(kuantitas_kg) total FROM batch_panen"
    )
);

$totalDistribusi = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM manifest_logistik"
    )
);

$grade = mysqli_query(
    $conn,
    "
    SELECT
        grade_panen,
        SUM(kuantitas_kg) total
    FROM batch_panen
    GROUP BY grade_panen
    "
);

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>📊 Laporan Sistem Logistik</h1>
        <p>Ringkasan data distribusi dan panen</p>
    </div>

    <div class="stats">

        <div class="stat-card">
            <h2>
                <?= number_format($totalPanen['total'],0,',','.'); ?>
                Kg
            </h2>
            <p>Total Panen</p>
        </div>

        <div class="stat-card">
            <h2>
                <?= $totalDistribusi['total']; ?>
            </h2>
            <p>Total Distribusi</p>
        </div>

    </div>

    <div class="card">

        <h2 style="margin-bottom:20px;">
            Laporan Grade Panen
        </h2>

        <table>

            <thead>
                <tr>
                    <th>Grade</th>
                    <th>Total Berat</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($grade)): ?>

                <tr>
                    <td><?= $row['grade_panen']; ?></td>
                    <td>
                        <?= number_format($row['total'],0,',','.'); ?>
                        Kg
                    </td>
                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

        <br>

        <a href="#" class="btn">
            Export PDF
        </a>

        <a href="#" class="btn">
            Export Excel
        </a>

    </div>

</div>

<?php include '../includes/footer.php'; ?>