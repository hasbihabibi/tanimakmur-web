<?php
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tgl       = $_POST['tanggal_panen'];
    $kuantitas = $_POST['kuantitas_kg'];
    $grade     = $_POST['grade_panen'];
    $harga     = $_POST['harga_per_kg'];
    $petani    = $_POST['id_petani'];
    $komoditas = $_POST['id_komoditas'];

    if($kuantitas <= 0 || $harga <= 0){
        $error_msg = "Kuantitas dan harga harus lebih besar dari 0";
    }else{

        $stmt = $conn->prepare("
        INSERT INTO batch_panen
        (
            tanggal_panen,
            kuantitas_kg,
            grade_panen,
            harga_per_kg_saat_ini,
            id_petani,
            id_komoditas
        )
        VALUES (?,?,?,?,?,?)
        ");

        $stmt->bind_param(
            "sdsdii",
            $tgl,
            $kuantitas,
            $grade,
            $harga,
            $petani,
            $komoditas
        );

        if($stmt->execute()){
            header("Location:index.php");
            exit;
        }

        $error_msg = $stmt->error;
    }
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<main class="main-content">

<div class="page-header">
    <h1>🌾 Tambah Batch Panen</h1>
    <p>Input data hasil panen baru</p>
</div>

<div class="card">

<?php if(isset($error_msg)): ?>
<div class="alert">
    <?= $error_msg ?>
</div>
<?php endif; ?>

<form method="POST">

<div class="form-row">

    <div class="form-group">
        <label>Tanggal Panen</label>
        <input
            type="date"
            name="tanggal_panen"
            required>
    </div>

    <div class="form-group">
        <label>Kuantitas (Kg)</label>
        <input
            type="number"
            step="0.01"
            name="kuantitas_kg"
            required>
    </div>

</div>

<div class="form-row">

    <div class="form-group">
        <label>Petani</label>

        <select name="id_petani" required>

            <option value="">
                Pilih Petani
            </option>

            <?php
            $petani = mysqli_query(
                $conn,
                "SELECT * FROM petani"
            );

            while($p = mysqli_fetch_assoc($petani)):
            ?>

            <option value="<?= $p['id_petani']; ?>">
                <?= $p['nama_petani']; ?>
            </option>

            <?php endwhile; ?>

        </select>

    </div>

    <div class="form-group">

        <label>Komoditas</label>

        <select
            name="id_komoditas"
            required>

            <option value="">
                Pilih Komoditas
            </option>

            <?php
            $komoditas = mysqli_query(
                $conn,
                "SELECT * FROM komoditas"
            );

            while($k = mysqli_fetch_assoc($komoditas)):
            ?>

            <option value="<?= $k['id_komoditas']; ?>">
                <?= $k['nama_komoditas']; ?>
            </option>

            <?php endwhile; ?>

        </select>

    </div>

</div>

<div class="form-row">

    <div class="form-group">

        <label>Grade Panen</label>

        <select
            name="grade_panen"
            required>

            <option value="Grade A">Grade A</option>
            <option value="Grade B">Grade B</option>
            <option value="Grade C">Grade C</option>

        </select>

    </div>

    <div class="form-group">

        <label>Harga per Kg</label>

        <input
            type="number"
            step="0.01"
            name="harga_per_kg"
            required>

    </div>

</div>

<div class="form-actions">

    <a
        href="index.php"
        class="btn-secondary">
        Batal
    </a>

    <button
        type="submit"
        class="btn-primary">
        Simpan Batch
    </button>

</div>

</form>

</div>

</main>

<?php include '../includes/footer.php'; ?>