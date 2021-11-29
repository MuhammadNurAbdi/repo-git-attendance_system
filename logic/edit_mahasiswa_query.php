<?php

if (!empty($_POST["save_update"])) {
    require_once("koneksi.php");

    $sql = $pdo_conn->prepare("UPDATE mahasiswa SET nim_mahasiswa = :nim_mahasiswa, nama_mahasiswa = :nama_mahasiswa, 
    email_mahasiswa = :email_mahasiswa, gender_mahasiswa = :gender_mahasiswa, 
    alamat_mahasiswa = :alamat_mahasiswa, fakultas_mahasiswa = :fakultas_mahasiswa, prodi_mahasiswa = :prodi_mahasiswa 
    WHERE nim_mahasiswa = " . $_GET["nim"]);
    $result = $sql->execute(array(
        ':nim_mahasiswa' => $_POST['nim'],
        ':nama_mahasiswa' => $_POST['nama'],
        ':email_mahasiswa' => $_POST['email'],
        ':gender_mahasiswa' => $_POST['gender'],
        ':alamat_mahasiswa' => $_POST['alamat'],
        ':fakultas_mahasiswa' => $_POST['fakultas'],
        ':prodi_mahasiswa' => $_POST['prodi']
    ));

    $data_akun = $pdo_conn->prepare("SELECT * FROM akun WHERE username = " . $_GET["nim"]); //query untuk mengambil data tabel
    $data_akun->execute();
    $result_akun = $data_akun->fetchAll();

    if ($result_akun[0]['password'] == $_POST['confirm_password'])
        $pass = $_POST['confirm_password'];
    else
        $pass = md5($_POST['confirm_password']);

    $sql = $pdo_conn->prepare("UPDATE akun SET username = :username, password = :password WHERE username = " . $_GET["nim"]);
    $result = $sql->execute(array(
        ':username' => $_POST['nim'],
        ':password' => $pass,
    ));

    if (!empty($result)) {
        header("location: ../list_mahasiswa.php");
    }
}
