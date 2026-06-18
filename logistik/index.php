<?php
require_once '../config/database.php';

$sql = "
SELECT
m.id_manifest,
m.tanggal_kirim,
m.status_kirim,
p.nama AS nama_pengirim,
pg.nama AS nama_pengepul,
pg.alamat_tujuan
FROM manifest_logistik m
LEFT JOIN pengirim p
ON m.id_pengirim=p.id_pengirim
LEFT JOIN pengepul pg
ON m.id_pengepul=pg.id_pengepul
ORDER BY m.id_manifest DESC
";

$result = $conn->query($sql);

$totalManifest = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) total FROM manifest_logistik"
))['total'];

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<main class="main-content">

<div class="page-header">
    <h1>Data Logistik</h1>
</div>

<div class="stats">

    <div class="stat-card">
        <h2><?= $totalManifest; ?></h2>
        <p>Total Manifest</p>
    </div>

</div>

<div class="card">

<table>

<tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Pengirim</th>
    <th>Pengepul</th>
    <th>Alamat</th>
    <th>Status</th>
</tr>

<?php while($row=$result->fetch_assoc()): ?>

<tr>

<td>MF-<?= $row['id_manifest']; ?></td>
<td><?= $row['tanggal_kirim']; ?></td>
<td><?= $row['nama_pengirim']; ?></td>
<td><?= $row['nama_pengepul']; ?></td>
<td><?= $row['alamat_tujuan']; ?></td>

<td>

<?php
$status = $row['status_kirim'];

if($status=="Diproses"){
    echo '<span class="badge diproses">Diproses</span>';
}
elseif($status=="Dikirim"){
    echo '<span class="badge dikirim">Dikirim</span>';
}
elseif($status=="Diterima"){
    echo '<span class="badge diterima">Diterima</span>';
}
else{
    echo '<span class="badge dibatalkan">Dibatalkan</span>';
}
?>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</main>

<?php include '../includes/footer.php'; ?>