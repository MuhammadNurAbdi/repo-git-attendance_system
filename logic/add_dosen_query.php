<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");

    $sql = $pdo_conn->prepare("INSERT INTO dosen (nip_dosen, nama_dosen, email_dosen, gender_dosen, alamat_dosen, fakultas_dosen, prodi_dosen) 
    VALUES (:nip_dosen, :nama_dosen, :email_dosen, :gender_dosen, :alamat_dosen, :fakultas_dosen, :prodi_dosen)");
    $result = $sql->execute(array(
        ':nip_dosen' => $_POST['nip'],
        ':nama_dosen' => $_POST['nama'],
        ':email_dosen' => $_POST['email'],
        ':gender_dosen' => $_POST['gender'],
        ':alamat_dosen' => $_POST['alamat'],
        ':fakultas_dosen' => $_POST['fakultas'],
        ':prodi_dosen' => $_POST['prodi']
    ));

    $sql = $pdo_conn->prepare("INSERT INTO akun (username, password, level) VALUES (:username, :password, :level)");
    $result = $sql->execute(array(
        ':username' => $_POST['nip'],
        ':password' => md5($_POST['confirm_password']),
        ':level' => 2
    ));

    if (!empty($result)) {
        header("location: ../user.php");
    }
} else {
    header("location: ../index.php");
}
