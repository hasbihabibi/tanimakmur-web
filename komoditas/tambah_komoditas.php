<?php
require_once '../config/database.php';

if(isset($_POST['simpan'])){

    $id = $_POST['id_komoditas'];
    $nama = $_POST['nama_komoditas'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "
    INSERT INTO komoditas
    (id_komoditas,nama_komoditas,deskripsi)
    VALUES
    ('$id','$nama','$deskripsi')
    ";

    if($conn->query($sql)){
        header("Location: index.php");
        exit;
    }
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>Tambah Komoditas</h1>
    </div>

    <div class="card">

        <form method="POST">

            <div class="form-group">
                <label>ID Komoditas</label>
                <input
                type="text"
                name="id_komoditas"
                placeholder="KMD001"
                required>
            </div>

            <div class="form-group">
                <label>Nama Komoditas</label>
                <input
                type="text"
                name="nama_komoditas"
                required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea
                name="deskripsi"
                rows="4"></textarea>
            </div>

            <button
            type="submit"
            name="simpan"
            class="btn">
            Simpan
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