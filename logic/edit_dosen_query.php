<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");

    $sql_nip = $pdo_conn->prepare('SELECT nip_dosen FROM dosen WHERE nip_dosen = :nip');
    $sql_nip->execute(array(
        ':nip' => $_POST['nip']
    ));
    $row_nip = $sql_nip->fetch(PDO::FETCH_ASSOC);

    $sql_user = $pdo_conn->prepare('SELECT username FROM akun WHERE username = :nip');
    $sql_user->execute(array(
        ':nip' => $_POST['nip']
    ));
    $row_user = $sql_user->fetch(PDO::FETCH_ASSOC);

    if ((empty($row_nim['nip_dosen']) && empty($row_user['username'])) || $_POST['nip'] == $_GET['nip']) {
        $sql = $pdo_conn->prepare("UPDATE dosen SET nip_dosen = :nip_dosen, nama_dosen = :nama_dosen, 
                                    email_dosen = :email_dosen, gender_dosen = :gender_dosen, 
                                    alamat_dosen = :alamat_dosen, fakultas_dosen = :fakultas_dosen, prodi_dosen = :prodi_dosen 
                                    WHERE nip_dosen = " . $_GET["nip"]);
        $result = $sql->execute(array(
            ':nip_dosen' => $_POST['nip'],
            ':nama_dosen' => $_POST['nama'],
            ':email_dosen' => $_POST['email'],
            ':gender_dosen' => $_POST['gender'],
            ':alamat_dosen' => $_POST['alamat'],
            ':fakultas_dosen' => $_POST['fakultas'],
            ':prodi_dosen' => $_POST['prodi']
        ));

        $data_akun = $pdo_conn->prepare("SELECT * FROM akun WHERE username = " . $_GET["nip"]); //query untuk mengambil data tabel
        $data_akun->execute();
        $result_akun = $data_akun->fetchAll();

        if ($result_akun[0]['password'] == $_POST['confirm_password'])
            $pass = $_POST['confirm_password'];
        else
            $pass = md5($_POST['confirm_password']);

        $sql = $pdo_conn->prepare("UPDATE akun SET username = :username, password = :password WHERE username = :old_username");
        $result = $sql->execute(array(
            ':old_username' => $_GET["nip"],
            ':username' => $_POST['nip'],
            ':password' => $pass,
        ));

        if (!empty($result)) {
            header("location: ../list_dosen.php");
        }
    } else {
        header("location: ../list_dosen.php");
    }
} else {
    header("location: ../index.php");
}
