<?php
require_once("koneksi.php");
$stmt = $pdo_conn->prepare("DELETE FROM mahasiswa WHERE nim_mahasiswa=" . $_GET['nim']);
$stmt->execute();
$stmt = $pdo_conn->prepare("DELETE FROM akun WHERE username=" . $_GET['nim']);
$stmt->execute();
header('location: ../list_mahasiswa.php');
