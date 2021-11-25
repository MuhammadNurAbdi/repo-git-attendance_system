<?php

if (!empty($_POST["save_update"])) {
    require_once("koneksi.php");

    $sql = $pdo_conn->prepare("UPDATE status_presensi SET status_presensi = :status_presensi WHERE kode_status_presensi = :kode_status");
    $result = $sql->execute(array(
        ':status_presensi' => $_POST['status'],
        ':kode_status' => $_POST['kode_status']
    ));

    if (!empty($result)) {
        header("location: ../kelolapresensi.php?id=" . $_GET['id'] . "&presensi=" . $_GET['presensi']);
    }
}
