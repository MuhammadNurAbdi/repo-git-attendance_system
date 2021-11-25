<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");

    $sql = $pdo_conn->prepare("INSERT INTO mahasiswa (nim_mahasiswa, nama_mahasiswa, foto_mahasiswa, email_mahasiswa, gender_mahasiswa, alamat_mahasiswa, fakultas_mahasiswa, prodi_mahasiswa) 
    VALUES (:nip_mahasiswa, :nama_mahasiswa, :foto_mahasiswa, :email_mahasiswa, :gender_mahasiswa, :alamat_mahasiswa, :fakultas_mahasiswa, :prodi_mahasiswa)");
    $result = $sql->execute(array(
        ':nip_mahasiswa' => $_POST['nim'],
        ':nama_mahasiswa' => $_POST['nama'],
        ':foto_mahasiswa' => '',
        ':email_mahasiswa' => $_POST['email'],
        ':gender_mahasiswa' => $_POST['gender'],
        ':alamat_mahasiswa' => $_POST['alamat'],
        ':fakultas_mahasiswa' => $_POST['fakultas'],
        ':prodi_mahasiswa' => $_POST['prodi']
    ));

    $sql = $pdo_conn->prepare("INSERT INTO akun (username, password, level) VALUES (:username, :password, :level)");
    $result = $sql->execute(array(
        ':username' => $_POST['nim'],
        ':password' => md5($_POST['confirm_password']),
        ':level' => 3
    ));

    if (!empty($result)) {
        header("location: ../user.php");
    }
}
