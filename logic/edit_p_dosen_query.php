<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");
    session_start();

    $sql = $pdo_conn->prepare("UPDATE dosen SET nama_dosen = :nama_dosen, 
    email_dosen = :email_dosen, gender_dosen = :gender_dosen, 
    alamat_dosen = :alamat_dosen, fakultas_dosen = :fakultas_dosen, prodi_dosen = :prodi_dosen 
    WHERE nip_dosen = :nip_dosen");
    $result = $sql->execute(array(
        ':nama_dosen' => $_POST['nama'],
        ':email_dosen' => $_POST['email'],
        ':gender_dosen' => $_POST['gender'],
        ':alamat_dosen' => $_POST['alamat'],
        ':fakultas_dosen' => $_POST['fakultas'],
        ':prodi_dosen' => $_POST['prodi'],
        ':nip_dosen' => $_SESSION['nip']
    ));

    if (!empty($result)) {
        header("location: ../profil_dosen.php");
    }
} else {
    header("location: ../index.php");
}
