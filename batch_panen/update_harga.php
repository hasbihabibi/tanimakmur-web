<?php
require_once '../config/database.php';

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $harga = floatval($_POST['harga_baru']);

    $conn->query("
        UPDATE batch_panen 
        SET harga_per_kg_saat_ini = $harga
        WHERE id_batch = $id
    ");

    header("Location: index.php");
    exit();
}

$data = $conn->query("
    SELECT * FROM batch_panen 
    WHERE id_batch = $id
")->fetch_assoc();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>Update Harga Panen</h1>
        <p>Perbarui harga per kilogram untuk batch panen</p>
    </div>

    <div class="card" style="max-width: 500px;">

        <div style="margin-bottom: 15px;">
            <strong>ID Batch:</strong> BP-<?= $data['id_batch']; ?>
        </div>

        <form method="POST">

            <label>Harga per Kg (Rp)</label>
            <input 
                type="number" 
                name="harga_baru" 
                value="<?= $data['harga_per_kg_saat_ini']; ?>" 
                required
                style="width: 100%; padding: 10px; margin: 8px 0 15px; border: 1px solid #ccc; border-radius: 6px;"
            >

            <button type="submit" class="btn">
                Simpan Perubahan
            </button>

        </form>

        <br>

        <a href="index.php" class="btn" style="background:#6c757d;">
            ← Kembali
        </a>

    </div>

</div>

<?php include '../includes/footer.php'; ?>