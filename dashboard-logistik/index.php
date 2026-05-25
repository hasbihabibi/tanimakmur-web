<?php
$cards = [
    [
        'title' => 'Total Panen',
        'value' => '7.050 kg',
        'desc' => 'Total hasil panen',
        'color' => 'green'
    ],
    [
        'title' => 'Distribusi',
        'value' => '4.830 kg',
        'desc' => 'Distribusi terkirim',
        'color' => 'red'
    ],
    [
        'title' => 'Komoditas',
        'value' => '3',
        'desc' => 'Cabai Merah, Rawit, Keriting',
        'color' => 'yellow'
    ],
    [
        'title' => 'Anggota Tani',
        'value' => '18',
        'desc' => 'Petani aktif',
        'color' => 'green'
    ]
];

$batches = [
    ['kode' => 'BP-001', 'grade' => 'Grade A', 'berat' => '200 Kg', 'status' => 'Siap Distribusi'],
    ['kode' => 'BP-002', 'grade' => 'Grade B', 'berat' => '120 Kg', 'status' => 'Proses'],
    ['kode' => 'BP-003', 'grade' => 'Grade C', 'berat' => '95 Kg', 'status' => 'Sorting'],
    ['kode' => 'BP-004', 'grade' => 'Grade A', 'berat' => '250 Kg', 'status' => 'Terkirim'],
];
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
                    Pengelolaan distribusi komoditas cabai dari lahan hingga pasar secara efisien,
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
                    <h4>Grade A</h4>
                    <p>Rp 55.000/kg</p>
                </div>

                <div class="mini-card">
                    <h4>Grade B</h4>
                    <p>Rp 40.000/kg</p>
                </div>

                <div class="mini-card">
                    <h4>Stok Siap Kirim</h4>
                    <p>4.830 kg</p>
                </div>

                <div class="mini-card">
                    <h4>Pengiriman Hari Ini</h4>
                    <p>3 Batch</p>
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
                    <h3>Tren Panen & Distribusi</h3>
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

                    <?php foreach($batches as $batch): ?>

                        <tr>
                            <td><?= $batch['kode']; ?></td>
                            <td><?= $batch['grade']; ?></td>
                            <td><?= $batch['berat']; ?></td>
                            <td>
                                <span class="status">
                                    <?= $batch['status']; ?>
                                </span>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </section>

    </main>

</div>

<script src="script.js"></script>
</body>
</html>