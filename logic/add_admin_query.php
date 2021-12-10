<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");

    $sql_user = $pdo_conn->prepare('SELECT username FROM akun WHERE username = :username');
    $sql_user->execute(array(
        ':username' => $_POST['username']
    ));
    $row_user = $sql_user->fetch(PDO::FETCH_ASSOC);

    if (empty($row_user['username'])) {
        $sql = $pdo_conn->prepare("INSERT INTO akun (username, password, level) VALUES (:username, :password, :level)");
        $result = $sql->execute(array(
            ':username' => $_POST['username'],
            ':password' => md5($_POST['confirm_password']),
            ':level' => 1
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
