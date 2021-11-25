<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");

    $sql = $pdo_conn->prepare("INSERT INTO akun (username, password, level) VALUES (:username, :password, :level)");
    $result = $sql->execute(array(
        ':username' => $_POST['username'],
        ':password' => md5($_POST['confirm_password']),
        ':level' => 1
    ));

    if (!empty($result)) {
        header("location: ../user.php");
    }
}
