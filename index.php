<?php require_once 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - TaniMakmur</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #3a6b41; padding-bottom: 15px; margin-bottom: 20px; }
        h2 { color: #333; margin: 0; }
        .btn { display: inline-block; padding: 10px 15px; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; font-weight: bold; }
        .btn-green { background-color: #3a6b41; color: white; }
        .btn-green:hover { background-color: #2c5232; }
        .btn-red { background-color: #d32f2f; color: white; font-size: 12px; padding: 6px 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #e0e0e0; padding: 12px; text-align: left; }
        th { background-color: #3a6b41; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }
        .badge { background: #e0e0e0; padding: 4px 8px; border-radius: 12px; font-size: 0.85em; font-weight: bold; color: #333; }
        .text-center { text-align: center; color: #777; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Dashboard Batch Panen</h2>
        <a href="tambah_batch.php" class="btn btn-green">+ Tambah Batch</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Batch</th>
                <th>Tanggal Panen</th>
                <th>Petani</th>
                <th>Komoditas</th>
                <th>Grade</th>
                <th>Kuantitas (kg)</th>
                <th>Harga/kg</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
                    echo "<td><span class='badge'>" . htmlspecialchars($row['grade_panen']) . "</span></td>";
                    echo "<td>" . htmlspecialchars($row['kuantitas_kg']) . " kg</td>";
                    echo "<td>Rp " . number_format($row['harga_per_kg_saat_ini'], 0, ',', '.') . "</td>";
                    echo "<td><a href='actions/delete_panen.php?id=" . $row['id_batch'] . "' class='btn btn-red' onclick='return confirm(\"Hapus data?\")'>Hapus</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>Data panen kosong.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>