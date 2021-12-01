<?php
require_once("koneksi.php");
session_start();
if ($_SESSION['level_user'] != "Admin")
    header('location: ../index.php');
else {
    $stmt = $pdo_conn->prepare("DELETE FROM dosen WHERE nip_dosen = :nip");
    $stmt->execute(array(
        ':nip' => $_GET['nip']
    ));
    $stmt = $pdo_conn->prepare("DELETE FROM akun WHERE username = :nip");
    $stmt->execute(array(
        ':nip' => $_GET['nip']
    ));
    header('location: ../list_dosen.php');
}
