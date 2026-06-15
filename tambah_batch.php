<?php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tgl       = $conn->real_escape_string($_POST['tanggal_panen']);
    $kuantitas = $conn->real_escape_string($_POST['kuantitas_kg']);
    $grade     = $conn->real_escape_string($_POST['grade_panen']);
    $harga     = $conn->real_escape_string($_POST['harga_per_kg']);
    $petani    = $conn->real_escape_string($_POST['id_petani']);
    $komoditas = $conn->real_escape_string($_POST['id_komoditas']);

    // 1. VALIDASI: Pastikan kuantitas dan harga tidak minus atau nol
    if ($kuantitas <= 0 || $harga <= 0) {
        $error_msg = "Gagal menyimpan: Kuantitas dan harga harus lebih besar dari 0!";
    } else {
        // 2. UPGRADE: Menggunakan Prepared Statement agar aman dari SQL Injection
        $stmt = $conn->prepare("INSERT INTO batch_panen (tanggal_panen, kuantitas_kg, grade_panen, harga_per_kg_saat_ini, id_petani, id_komoditas) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            // "sdssii" artinya tipe data: string, double (float), string, string, integer, integer
            $stmt->bind_param("sdssii", $tgl, $kuantitas, $grade, $harga, $petani, $komoditas);
            
            if ($stmt->execute()) {
                $stmt->close();
                header("Location: index.php");
                exit();
            } else {
                $error_msg = "Gagal menyimpan: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_msg = "Gagal menyiapkan query: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Batch - TaniMakmur</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; width: 100%; max-width: 600px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; }
        .card-header { background-color: #3a6b41; color: white; padding: 15px 20px; font-weight: bold; font-size: 18px; }
        .card-body { padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-row { display: flex; gap: 15px; }
        .form-col { flex: 1; }
        label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px; color: #333; }
        input[type="date"], input[type="number"], select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; }
        .btn-group { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; font-weight: bold; }
        .btn-green { background-color: #3a6b41; color: white; }
        .btn-grey { background-color: #f1f1f1; color: #333; border: 1px solid #ccc; }
        .alert { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="card">
    <div class="card-header">Input Batch Panen Baru</div>
    <div class="card-body">
        <?php if(isset($error_msg)) echo "<div class='alert'>$error_msg</div>"; ?>
        
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group form-col">
                    <label>Tanggal Panen</label>
                    <input type="date" name="tanggal_panen" required>
                </div>
                <div class="form-group form-col">
                    <label>Kuantitas (kg)</label>
                    <input type="number" step="0.01" name="kuantitas_kg" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group form-col">
                    <label>Petani Penggarap</label>
                    <select name="id_petani" required>
                        <option value="">-- Pilih Petani --</option>
                        <?php
                        $res_petani = $conn->query("SELECT id_petani, nama_petani FROM petani");
                        while($p = $res_petani->fetch_assoc()) echo "<option value='".$p['id_petani']."'>".$p['nama_petani']."</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group form-col">
                    <label>Komoditas</label>
                    <select name="id_komoditas" required>
                        <option value="">-- Pilih Komoditas --</option>
                        <?php
                        $res_komo = $conn->query("SELECT id_komoditas, nama_komoditas FROM komoditas");
                        while($k = $res_komo->fetch_assoc()) echo "<option value='".$k['id_komoditas']."'>".$k['nama_komoditas']."</option>";
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group form-col">
                    <label>Grade Panen</label>
                    <select name="grade_panen" required>
                        <option value="Grade A">Grade A</option>
                        <option value="Grade B">Grade B</option>
                        <option value="Grade C">Grade C</option>
                    </select>
                </div>
                <div class="form-group form-col">
                    <label>Harga per Kg</label>
                    <input type="number" step="0.01" name="harga_per_kg" required>
                </div>
            </div>

            <div class="btn-group">
                <a href="index.php" class="btn btn-grey">Batal</a>
                <button type="submit" class="btn btn-green">Simpan Batch</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>