<?php
require_once("koneksi.php");
session_start();
if ($_SESSION['level_user'] != "Admin")
    header('location: ../index.php');
else {
    $stmt = $pdo_conn->prepare("DELETE FROM mahasiswa WHERE nim_mahasiswa = :nim");
    $stmt->execute(array(
        ':nim' => $_GET['nim']
    ));
    $stmt = $pdo_conn->prepare("DELETE FROM akun WHERE username = :nim");
    $stmt->execute(array(
        ':nim' => $_GET['nim']
    ));
    header('location: ../list_mahasiswa.php');
}
