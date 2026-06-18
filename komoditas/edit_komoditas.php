<?php
require_once '../config/database.php';

$id = $_GET['id'];

$data = mysqli_query(
$conn,
"SELECT * FROM komoditas
WHERE id_komoditas='$id'"
);

$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama_komoditas'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn,"
    UPDATE komoditas SET
    nama_komoditas='$nama',
    deskripsi='$deskripsi'
    WHERE id_komoditas='$id'
    ");

    header("Location:index.php");
    exit;
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>Edit Komoditas</h1>
    </div>

    <div class="card">

        <form method="POST">

            <div class="form-group">
                <label>ID Komoditas</label>

                <input
                type="text"
                value="<?= $row['id_komoditas']; ?>"
                readonly>
            </div>

            <div class="form-group">
                <label>Nama Komoditas</label>

                <input
                type="text"
                name="nama_komoditas"
                value="<?= $row['nama_komoditas']; ?>"
                required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>

                <textarea
                name="deskripsi"
                rows="4"><?= $row['deskripsi']; ?></textarea>
            </div>

            <button
            type="submit"
            name="update"
            class="btn">
            Update
            </button>

            <a
            href="index.php"
            class="btn-delete">
            Batal
            </a>

        </form>

    </div>

</div>

<?php include '../includes/footer.php'; ?>