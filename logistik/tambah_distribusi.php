<?php
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_batch      = $conn->real_escape_string($_POST['id_batch']);
    $nama_driver   = $conn->real_escape_string($_POST['nama_driver']);
    $plat_nomor    = $conn->real_escape_string($_POST['plat_nomor']);
    $tanggal_kirim = $conn->real_escape_string($_POST['tanggal_kirim']);

    // Sekarang kita pakai UPDATE, bukan INSERT INTO distribusi
    $stmt = $conn->prepare("UPDATE batch_panen SET nama_driver = ?, plat_nomor = ?, tanggal_kirim = ?, status_distribusi = 'Dalam Perjalanan' WHERE id_batch = ?");
    $stmt->bind_param("sssi", $nama_driver, $plat_nomor, $tanggal_kirim, $id_batch);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: index.php");
        exit();
    } else {
        $error_msg = "Gagal memproses pengiriman: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengiriman - Logistik</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; width: 100%; max-width: 600px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { background-color: #3a6b41; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
<div class="card">
    <h2>Input Pengiriman Logistik Baru</h2>
    <?php if(isset($error_msg)) echo "<p style='color:red;'>$error_msg</p>"; ?>
    
    <form method="POST" action="">
        <div class="form-group">
            <label>Pilih Batch Panen yang Mau Dikirim</label>
            <select name="id_batch" required>
                <option value="">-- Pilih Batch Panen --</option>
                <?php
                // Hanya mengambil batch panen yang statusnya masih 'Belum Dikirim'
                $res_batch = $conn->query("SELECT b.id_batch, k.nama_komoditas, b.tanggal_panen, b.kuantitas_kg 
                                           FROM batch_panen b 
                                           JOIN komoditas k ON b.id_komoditas = k.id_komoditas
                                           WHERE b.status_distribusi = 'Belum Dikirim'");
                while($b = $res_batch->fetch_assoc()) {
                    echo "<option value='".$b['id_batch']."'>ID: ".$b['id_batch']." - ".$b['nama_komoditas']." (".$b['kuantitas_kg']." kg)</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Nama Driver / Kurir</label>
            <input type="text" name="nama_driver" required>
        </div>
        <div class="form-group">
            <label>Plat Nomor Kendaraan</label>
            <input type="text" name="plat_nomor" required>
        </div>
        <div class="form-group">
            <label>Tanggal Pengiriman</label>
            <input type="date" name="tanggal_kirim" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <button type="submit" class="btn">Kirim Barang</button>
    </form>
</div>
</body>
</html>