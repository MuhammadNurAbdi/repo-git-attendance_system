<?php

if (!empty($_POST["save_update"])) {
    require_once("koneksi.php");
    session_start();

    $data_akun = $pdo_conn->prepare("SELECT * FROM akun WHERE username = " . $_SESSION["nip"]); //query untuk mengambil data tabel
    $data_akun->execute();
    $result_akun = $data_akun->fetchAll();

    if ($result_akun[0]['password'] == md5($_POST['password_old'])) {
        $pass = md5($_POST['confirm_password']);

        $sql = $pdo_conn->prepare("UPDATE akun SET password = :password WHERE username = :username");
        $result = $sql->execute(array(
            ':username' => $_SESSION["nip"],
            ':password' => $pass
        ));

        if (!empty($result)) {
            header("location: ../edit_password_dosen.php");
        }
    } else {
        $_SESSION['wrong'] = "Password salah";
        header("location: ../edit_password_dosen.php");
    }
}
