<?php require_once 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - TaniMakmur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard Batch Panen</h2>
        <a href="tambah_batch.php" class="btn btn-success">+ Tambah Batch Panen</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>ID Batch</th>
                        <th>Tanggal Panen</th>
                        <th>Petani</th>
                        <th>Komoditas</th>
                        <th>Grade</th>
                        <th>Kuantitas (kg)</th>
                        <th>Harga/kg</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Kueri Relasional (JOIN) yang membuktikan PDM Anda bekerja
                    $sql = "SELECT b.id_batch, b.tanggal_panen, b.kuantitas_kg, b.grade_panen, b.harga_per_kg_saat_ini, 
                                   p.nama_petani, k.nama_komoditas 
                            FROM batch_panen b
                            LEFT JOIN petani p ON b.id_petani = p.id_petani
                            LEFT JOIN komoditas k ON b.id_komoditas = k.id_komoditas
                            ORDER BY b.tanggal_panen DESC";
                    
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><strong>BP-" . htmlspecialchars($row['id_batch']) . "</strong></td>";
                            echo "<td>" . htmlspecialchars($row['tanggal_panen']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_petani']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_komoditas']) . "</td>";
                            echo "<td><span class='badge bg-secondary'>" . htmlspecialchars($row['grade_panen']) . "</span></td>";
                            echo "<td>" . htmlspecialchars($row['kuantitas_kg']) . " kg</td>";
                            echo "<td>Rp " . number_format($row['harga_per_kg_saat_ini'], 0, ',', '.') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center text-muted'>Data panen kosong.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>