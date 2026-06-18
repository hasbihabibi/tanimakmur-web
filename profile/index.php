<?php
session_start();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">

    <div class="page-header">
        <h1>Profil Pengguna</h1>
        <p>Informasi akun yang sedang login</p>
    </div>

    <div class="card">

        <table>

            <tr>
                <td>Username</td>
                <td><?= $_SESSION['nama']; ?></td>
            </tr>

        </table>

    </div>

</div>

<?php include '../includes/footer.php'; ?>