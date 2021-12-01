<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");
    session_start();

    $sql = $pdo_conn->prepare("UPDATE mahasiswa SET nama_mahasiswa = :nama_mahasiswa, 
    email_mahasiswa = :email_mahasiswa, gender_mahasiswa = :gender_mahasiswa, 
    alamat_mahasiswa = :alamat_mahasiswa, fakultas_mahasiswa = :fakultas_mahasiswa, prodi_mahasiswa = :prodi_mahasiswa 
    WHERE nim_mahasiswa = " . $_SESSION["nim"]);
    $result = $sql->execute(array(
        ':nama_mahasiswa' => $_POST['nama'],
        ':email_mahasiswa' => $_POST['email'],
        ':gender_mahasiswa' => $_POST['gender'],
        ':alamat_mahasiswa' => $_POST['alamat'],
        ':fakultas_mahasiswa' => $_POST['fakultas'],
        ':prodi_mahasiswa' => $_POST['prodi']
    ));

    if (!empty($result)) {
        header("location: ../profil_mahasiswa.php");
    }
} else {
    header("location: ../index.php");
}
