<?php
require_once("koneksi.php");
session_start();
if ($_SESSION['level_user'] != "Admin")
    header('location: ../index.php');
else {
    $stmt = $pdo_conn->prepare("DELETE FROM kelas WHERE kode_kelas = :kode_kelas");
    $stmt->execute(array(
        ':kode_kelas' => $_GET['id']
    ));
    header('location: ../index.php');
}
