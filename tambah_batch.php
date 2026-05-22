<?php
require_once 'config/database.php';

// Logika Pemrosesan saat tombol Simpan ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tgl       = $conn->real_escape_string($_POST['tanggal_panen']);
    $kuantitas = $conn->real_escape_string($_POST['kuantitas_kg']);
    $grade     = $conn->real_escape_string($_POST['grade_panen']);
    $harga     = $conn->real_escape_string($_POST['harga_per_kg']);
    $petani    = $conn->real_escape_string($_POST['id_petani']);
    $komoditas = $conn->real_escape_string($_POST['id_komoditas']);

    $sql_insert = "INSERT INTO batch_panen (tanggal_panen, kuantitas_kg, grade_panen, harga_per_kg_saat_ini, id_petani, id_komoditas) 
                   VALUES ('$tgl', '$kuantitas', '$grade', '$harga', '$petani', '$komoditas')";
    
    if ($conn->query($sql_insert) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        $error_msg = "Gagal menyimpan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Batch - TaniMakmur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Input Batch Panen Baru</h5>
                </div>
                <div class="card-body">
                    <?php if(isset($error_msg)) echo "<div class='alert alert-danger'>$error_msg</div>"; ?>
                    
                    <form method="POST" action="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Panen</label>
                                <input type="date" name="tanggal_panen" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kuantitas (kg)</label>
                                <input type="number" step="0.01" name="kuantitas_kg" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Petani Penggarap</label>
                                <select name="id_petani" class="form-select" required>
                                    <option value="">-- Pilih Petani --</option>
                                    <?php
                                    $res_petani = $conn->query("SELECT id_petani, nama_petani FROM petani");
                                    while($p = $res_petani->fetch_assoc()) {
                                        echo "<option value='".$p['id_petani']."'>".$p['nama_petani']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Komoditas</label>
                                <select name="id_komoditas" class="form-select" required>
                                    <option value="">-- Pilih Komoditas --</option>
                                    <?php
                                    $res_komo = $conn->query("SELECT id_komoditas, nama_komoditas FROM komoditas");
                                    while($k = $res_komo->fetch_assoc()) {
                                        echo "<option value='".$k['id_komoditas']."'>".$k['nama_komoditas']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Grade Panen</label>
                                <select name="grade_panen" class="form-select" required>
                                    <option value="Grade A">Grade A</option>
                                    <option value="Grade B">Grade B</option>
                                    <option value="Grade C">Grade C</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga per Kg (Saat Ini)</label>
                                <input type="number" step="0.01" name="harga_per_kg" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="index.php" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan Batch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>