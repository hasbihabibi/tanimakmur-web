<?php
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id_batch = $conn->real_escape_string($_GET['id']);

    $sql = "SELECT b.*, k.nama_komoditas, p.nama_petani
            FROM batch_panen b
            JOIN komoditas k ON b.id_komoditas = k.id_komoditas
            JOIN petani p ON b.id_petani = p.id_petani
            WHERE b.id_batch = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_batch);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Distribusi Batch #<?= $data['id_batch']; ?></title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; width: 100%; max-width: 650px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; }
        .card-header { background-color: #2c3e50; color: white; padding: 15px 20px; font-weight: bold; font-size: 18px; }
        .card-body { padding: 20px; }
        .section-title { font-size: 16px; font-weight: bold; color: #2c3e50; border-bottom: 2px solid #ecf0f1; padding-bottom: 5px; margin-top: 15px; margin-bottom: 10px; }
        table { width: 100%; margin-bottom: 15px; }
        td { padding: 6px 0; font-size: 14px; }
        td.label { width: 35%; color: #7f8c8d; font-weight: bold; }
        td.value { color: #2c3e50; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; background-color: #7f8c8d; color: white; display: inline-block; margin-top: 15px; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; color: white; }
        .badge-otw { background-color: #f39c12; }
        .badge-done { background-color: #2ecc71; }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">Detail Pengiriman Batch #<?= $data['id_batch']; ?></div>
    <div class="card-body">
        
        <div class="section-title">Informasi Logistik</div>
        <table>
            <tr>
                <td class="label">Nama Driver</td>
                <td class="value">: <?= $data['nama_driver']; ?></td>
            </tr>
            <tr>
                <td class="label">Plat Kendaraan</td>
                <td class="value">: <?= $data['plat_nomor']; ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal Kirim</td>
                <td class="value">: <?= $data['tanggal_kirim']; ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal Sampai</td>
                <td class="value">: <?= $data['tanggal_sampai'] ? $data['tanggal_sampai'] : '<em style="color:#95a5a6;">Belum Sampai</em>'; ?></td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="value">: 
                    <span class="badge <?= $data['status_distribusi'] == 'Dalam Perjalanan' ? 'badge-otw' : 'badge-done'; ?>">
                        <?= $data['status_distribusi']; ?>
                    </span>
                </td>
            </tr>
        </table>

        <div class="section-title">Detail Hasil Panen</div>
        <table>
            <tr>
                <td class="label">Komoditas</td>
                <td class="value">: <strong><?= $data['nama_komoditas']; ?></strong></td>
            </tr>
            <tr>
                <td class="label">Kuantitas</td>
                <td class="value">: <?= $data['kuantitas_kg']; ?> kg</td>
            </tr>
            <tr>
                <td class="label">Grade</td>
                <td class="value">: <?= $data['grade_panen']; ?></td>
            </tr>
            <tr>
                <td class="label">Petani</td>
                <td class="value">: <?= $data['nama_petani']; ?></td>
            </tr>
        </table>

        <a href="index.php" class="btn">Kembali ke Daftar</a>
    </div>
</div>

</body>
</html>