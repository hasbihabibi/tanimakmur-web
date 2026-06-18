<?php
require_once '../config/database.php';

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM petani WHERE id_petani='$id'"
);

header("Location:index.php");
exit;