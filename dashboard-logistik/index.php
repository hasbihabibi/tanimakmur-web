<?php
require_once '../config/database.php';

$result = $conn->query("
    SELECT SUM(kuantitas_kg) AS total
    FROM batch_panen
");
$data = $result->fetch_assoc();
$totalPanen = $data['total'] ?? 0;

$result = $conn->query("
    SELECT COUNT(*) AS total
    FROM petani
");
$data = $result->fetch_assoc();
$totalPetani = $data['total'];

$result = $conn->query("
    SELECT COUNT(*) AS total
    FROM komoditas
");
$data = $result->fetch_assoc();
$totalKomoditas = $data['total'];

$result = $conn->query("
    SELECT COUNT(*) AS total
    FROM batch_panen
");
$data = $result->fetch_assoc();
$totalBatch = $data['total'];

$cards = [
    [
        'title' => 'Total Panen',
        'value' => number_format($totalPanen,0,',','.').' Kg',
        'desc' => 'Total hasil panen',
        'color' => 'green'
    ],
    [
        'title' => 'Total Batch',
        'value' => $totalBatch,
        'desc' => 'Batch panen tercatat',
        'color' => 'red'
    ],
    [
        'title' => 'Komoditas',
        'value' => $totalKomoditas,
        'desc' => 'Jenis komoditas',
        'color' => 'yellow'
    ],
    [
        'title' => 'Petani',
        'value' => $totalPetani,
        'desc' => 'Petani terdaftar',
        'color' => 'green'
    ]
];

$sqlBatch = "
SELECT
    id_batch,
    grade_panen,
    kuantitas_kg
FROM batch_panen
ORDER BY tanggal_panen DESC
LIMIT 5
";

$resultBatch = $conn->query($sqlBatch);

$sqlGrade = "
SELECT
    grade_panen,
    SUM(kuantitas_kg) AS total
FROM batch_panen
GROUP BY grade_panen
";

$resultGrade = $conn->query($sqlGrade);

$gradeLabel = [];
$gradeData = [];

while($row = $resultGrade->fetch_assoc()) {
    $gradeLabel[] = $row['grade_panen'];
    $gradeData[] = (float)$row['total'];
}

$sqlLine = "
SELECT
DATE_FORMAT(tanggal_panen,'%d-%m') AS periode,
SUM(kuantitas_kg) AS total
FROM batch_panen
GROUP BY tanggal_panen
ORDER BY tanggal_panen
";

$resultLine = $conn->query($sqlLine);

$lineLabel = [];
$lineData = [];

while($row = $resultLine->fetch_assoc()){

    $lineLabel[] = $row['periode'];
    $lineData[] = (float)$row['total'];

}

$sqlStatus = "
SELECT
status_kirim,
COUNT(*) AS total
FROM manifest_logistik
GROUP BY status_kirim
";

$resultStatus = $conn->query($sqlStatus);

$statusLabel = [];
$statusData = [];

while($row = $resultStatus->fetch_assoc()){

    $statusLabel[] = $row['status_kirim'];
    $statusData[] = (int)$row['total'];

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Logistik</title>

    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">

    <aside class="sidebar">
        <div class="logo">
            <h2>Tani Makmur</h2>
            <p>Dashboard Logistik</p>
        </div>

        <nav>
            <ul>
                <li class="active">Dashboard</li>
                <li>Data Master</li>
                <li>Batch Panen</li>
                <li>Logistik</li>
                <li>Laporan</li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <input type="text" placeholder="Cari data...">

            <div class="profile">
                <div class="notif"></div>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="background-color: #f1f5f9; border-radius: 50%; padding: 6px; color: #64748b; cursor: pointer;">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
            </svg>
            </div>
        </header>

        <section class="hero">
            <div class="hero-left">
                <span class="badge">Kelompok Tani Makmur • Desa Watukebo</span>

                <h1>
                    Sistem Informasi Logistik
                    <span>Pasca-Panen Multi-Grade</span>
                </h1>

                <p>
                    Pengelolaan distribusi hasil panen multi-komoditas dari petani hingga pengepul secara efisien,
                    transparan, dan berbasis data real-time.
                </p>

                <div class="hero-buttons">
                    <button>Catat Batch Panen</button>
                    <button class="secondary">Kelola Distribusi</button>
                    <button class="secondary">Laporan</button>
                </div>
            </div>

            <div class="hero-right">

    <div class="mini-card">
        <h4>Total Panen</h4>
        <p><?= number_format($totalPanen,0,',','.'); ?> Kg</p>
    </div>

    <div class="mini-card">
        <h4>Total Batch</h4>
        <p><?= $totalBatch; ?></p>
    </div>

    <div class="mini-card">
        <h4>Total Komoditas</h4>
        <p><?= $totalKomoditas; ?></p>
    </div>

    <div class="mini-card">
        <h4>Total Petani</h4>
        <p><?= $totalPetani; ?></p>
    </div>

</div>
        </section>

        <section class="stats-grid">

            <?php foreach($cards as $card): ?>

            <div class="stat-card">
                <div class="icon <?= $card['color']; ?>"></div>

                <div>
                    <h3><?= $card['value']; ?></h3>
                    <h4><?= $card['title']; ?></h4>
                    <p><?= $card['desc']; ?></p>
                </div>
            </div>

            <?php endforeach; ?>

        </section>

        <section class="charts-grid">

            <div class="chart-box large">
                <div class="box-header">
                    <h3>Tren Panen</h3>
                </div>

                <canvas id="lineChart"></canvas>
            </div>

            <div class="chart-box small">
                <div class="box-header">
                    <h3>Status Distribusi</h3>
                </div>

                <canvas id="doughnutChart"></canvas>
            </div>

        </section>

        <section class="charts-grid second">

            <div class="chart-box">
                <div class="box-header">
                    <h3>Volume Panen per Grade</h3>
                </div>

                <canvas id="barChart"></canvas>
            </div>

        </section>

        <section class="table-section">

            <div class="table-box">
                <div class="box-header">
                    <h3>Batch Panen Terbaru</h3>
                    <button>Lihat Semua</button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Grade</th>
                            <th>Berat</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                   <tbody>

<?php while($batch = $resultBatch->fetch_assoc()): ?>

<tr>
    <td>BP-<?= $batch['id_batch']; ?></td>
    <td><?= $batch['grade_panen']; ?></td>
    <td><?= number_format($batch['kuantitas_kg'],0,',','.'); ?> Kg</td>
    <td>
        <span class="status">
            Tersimpan
        </span>
    </td>
</tr>

<?php endwhile; ?>

</tbody>
                </table>
            </div>

        </section>

    </main>

</div>

<script>

const gradeLabel =
<?= json_encode($gradeLabel); ?>;

const gradeData =
<?= json_encode($gradeData); ?>;

const lineLabel =
<?= json_encode($lineLabel); ?>;

const lineData =
<?= json_encode($lineData); ?>;

const statusLabel =
<?= json_encode($statusLabel); ?>;

const statusData =
<?= json_encode($statusData); ?>;

</script>

<script src="script.js"></script>
</body>
</html>