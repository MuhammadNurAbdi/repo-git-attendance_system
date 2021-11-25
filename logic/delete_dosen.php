<?php
require_once("koneksi.php");
$stmt = $pdo_conn->prepare("DELETE FROM dosen WHERE nip_dosen=" . $_GET['nip']);
$stmt->execute();
$stmt = $pdo_conn->prepare("DELETE FROM akun WHERE username=" . $_GET['nip']);
$stmt->execute();
header('location: ../list_dosen.php');
