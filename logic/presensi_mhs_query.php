<?php

require_once("koneksi.php");
session_start();
if ($_SESSION['level_user'] != "Mahasiswa")
    header('location: ../index.php');
else {
    $status = 'Hadir';
    $sql = $pdo_conn->prepare("UPDATE status_presensi SET status_presensi = :status_presensi WHERE kode_presensi = :kode_presensi AND nim_mahasiswa = :nim_mahasiswa");
    $result = $sql->execute(array(
        ':status_presensi' => $status,
        ':kode_presensi' => $_GET['presensi'],
        ':nim_mahasiswa' => $_SESSION['nim']
    ));

    header("location: ../presensi_mhs.php?id=" . $_GET['id']);
}
