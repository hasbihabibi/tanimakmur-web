<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php'; 

// Cukup query ke tabel batch_panen karena semua kolom sudah menyatu di sini
$sql = "SELECT b.*, k.nama_komoditas 
        FROM batch_panen b
        JOIN komoditas k ON b.id_komoditas = k.id_komoditas
        WHERE b.status_distribusi != 'Belum Dikirim'
        ORDER BY b.id_batch DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Logistik - TaniMakmur</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        h2 { margin: 0; color: #2c3e50; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; display: inline-block; }
        .btn-blue { background-color: #2980b9; color: white; }
        .btn-green { background-color: #27ae60; color: white; }
        .btn-red { background-color: #c0392b; color: white; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #2c3e50; color: white; }
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .badge-otw { background-color: #f39c12; color: white; }
        .badge-done { background-color: #2ecc71; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Data Pengiriman Logistik (Satu Tabel)</h2>
        <a href="tambah_distribusi.php" class="btn btn-blue">+ Input Pengiriman Baru</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Batch</th>
                <th>Komoditas (Kuantitas)</th>
                <th>Driver</th>
                <th>Plat Nomor</th>
                <th>Tgl Kirim</th>
                <th>Tgl Sampai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_batch']; ?></td>
                        <td><strong><?php echo $row['nama_komoditas']; ?></strong> (<?php echo $row['kuantitas_kg']; ?> kg)</td>
                        <td><?php echo $row['nama_driver']; ?></td>
                        <td><?php echo $row['plat_nomor']; ?></td>
                        <td><?php echo $row['tanggal_kirim']; ?></td>
                        <td><?php echo $row['tanggal_sampai'] ? $row['tanggal_sampai'] : '-'; ?></td>
                        <td>
                            <?php if($row['status_distribusi'] == 'Dalam Perjalanan'): ?>
                                <span class="badge badge-otw">Dalam Perjalanan</span>
                            <?php else: ?>
                                <span class="badge badge-done">Sampai Tujuan</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="detail_distribusi.php?id=<?php echo $row['id_batch']; ?>" class="btn btn-blue" style="font-size:12px; padding:4px 8px;">Detail</a>
                            
                            <?php if($row['status_distribusi'] == 'Dalam Perjalanan'): ?>
                                <a href="update_status.php?id=<?php echo $row['id_batch']; ?>" class="btn btn-green" style="font-size:12px; padding:4px 8px;" onclick="return confirm('Konfirmasi bahwa barang telah sampai?')">Set Sampai</a>
                            <?php endif; ?>
                            
                            <a href="delete_distribusi.php?id=<?php echo $row['id_batch']; ?>" class="btn btn-red" style="font-size:12px; padding:4px 8px;" onclick="return confirm('Batalkan pengiriman logistik untuk batch ini?')">Batal Kirim</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align: center; color: #7f8c8d;">Belum ada data pengiriman logistik.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>