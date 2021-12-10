<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");

    $sql_nim = $pdo_conn->prepare('SELECT nim_mahasiswa FROM mahasiswa WHERE nim_mahasiswa = :nim');
    $sql_nim->execute(array(
        ':nim' => $_POST['nim']
    ));
    $row_nim = $sql_nim->fetch(PDO::FETCH_ASSOC);

    $sql_user = $pdo_conn->prepare('SELECT username FROM akun WHERE username = :nim');
    $sql_user->execute(array(
        ':nim' => $_POST['nim']
    ));
    $row_user = $sql_user->fetch(PDO::FETCH_ASSOC);

    if (empty($row_nim['nim_mahasiswa']) && empty($row_user['username'])) {
        $sql = $pdo_conn->prepare("INSERT INTO mahasiswa (nim_mahasiswa, nama_mahasiswa, email_mahasiswa, gender_mahasiswa, alamat_mahasiswa, fakultas_mahasiswa, prodi_mahasiswa) 
                                    VALUES (:nip_mahasiswa, :nama_mahasiswa, :email_mahasiswa, :gender_mahasiswa, :alamat_mahasiswa, :fakultas_mahasiswa, :prodi_mahasiswa)");
        $result = $sql->execute(array(
            ':nip_mahasiswa' => $_POST['nim'],
            ':nama_mahasiswa' => $_POST['nama'],
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
    } else {
        header("location: ../user.php");
    }
} else {
    header("location: ../index.php");
}
