<?php
require_once '../config/database.php';

$id = $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM petani WHERE id_petani='$id'"
);

$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama_petani'];
    $password = $_POST['password'];
    $telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn,"
    UPDATE petani SET
    nama_petani='$nama',
    password='$password',
    no_telepon='$telepon',
    alamat='$alamat'
    WHERE id_petani='$id'
    ");

    header("Location: index.php");
    exit;
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>Edit Petani</h1>
        <p>Perbarui data petani</p>
    </div>

    <div class="card">

        <form method="POST">

            <div class="form-group">

                <label>Nama Petani</label>

                <input
                    type="text"
                    name="nama_petani"
                    value="<?= $row['nama_petani']; ?>"
                    required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                    type="text"
                    name="password"
                    value="<?= $row['password']; ?>"
                    required>

            </div>

            <div class="form-group">

                <label>No Telepon</label>

                <input
                    type="text"
                    name="no_telepon"
                    value="<?= $row['no_telepon']; ?>"
                    required>

            </div>

            <div class="form-group">

                <label>Alamat</label>

                <textarea
                    name="alamat"
                    rows="4"
                    required><?= $row['alamat']; ?></textarea>

            </div>

            <div class="form-actions">

                <a
                    href="index.php"
                    class="btn btn-secondary">
                    Batal
                </a>

                <button
                    type="submit"
                    name="update"
                    class="btn btn-success">
                    Update Data
                </button>

            </div>

        </form>

    </div>

</div>

<?php include '../includes/footer.php'; ?>