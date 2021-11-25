<?php
require_once("koneksi.php");
$stmt = $pdo_conn->prepare("DELETE FROM presensi WHERE kode_presensi = :kode_presensi");
$stmt->execute(array(
    ':kode_presensi' => $_GET['presensi']
));


$sql = $pdo_conn->prepare("DELETE FROM status_presensi WHERE kode_presensi = :kode_presensi");
$result = $sql->execute(array(
    ':kode_presensi' => $_GET['presensi']
));

header('location: ../presensi.php?id=' . $_GET['id']);
