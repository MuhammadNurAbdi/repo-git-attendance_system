<?php
require_once("koneksi.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = $pdo_conn->prepare('SELECT * FROM akun WHERE username = :username and password = :password');
    $sql->execute(array(
        ':username' => $_POST['InputUsername'],
        ':password' => md5($_POST['InputPassword'])
    ));
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    if (empty($row['username'])) {
        $_SESSION['wrong'] = "Username atau Password salah";
        header("location: ../login.php");
    } else {
        if ($row['level'] == 1) {
            $_SESSION['login_user'] = $_POST['InputUsername'];
            $_SESSION['level_user'] = "Admin";
        }
        if ($row['level'] == 2) {
            $sqldosen = $pdo_conn->prepare('SELECT * FROM dosen WHERE nip_dosen = :username');
            $sqldosen->execute(array(
                ':username' => $row['username']
            ));
            $row_dosen = $sqldosen->fetch(PDO::FETCH_ASSOC);
            $_SESSION['login_user'] = $row_dosen['nama_dosen'];
            $_SESSION['nip'] = $row_dosen['nip_dosen'];
            $_SESSION['level_user'] = "Dosen";
        }
        if ($row['level'] == 3) {
            $sqlmahasiswa = $pdo_conn->prepare('SELECT * FROM mahasiswa WHERE nim_mahasiswa = :username');
            $sqlmahasiswa->execute(array(
                ':username' => $row['username']
            ));
            $row_mahasiswa = $sqlmahasiswa->fetch(PDO::FETCH_ASSOC);
            $_SESSION['login_user'] = $row_mahasiswa['nama_mahasiswa'];
            $_SESSION['nim'] = $row_mahasiswa['nim_mahasiswa'];
            $_SESSION['level_user'] = "Mahasiswa";
        }

        header("location: ../index.php");
    }
} else {
    header("location: ../index.php");
}
