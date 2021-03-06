<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");

    $sql = $pdo_conn->prepare("UPDATE presensi SET pertemuan = :pertemuan, bahasan = :bahasan, waktu_mulai = :waktu_mulai, waktu_akhir = :waktu_akhir WHERE kode_presensi = :kode_presensi");
    $result = $sql->execute(array(
        ':pertemuan' => $_POST['pertemuan'],
        ':bahasan' => $_POST['bahasan'],
        ':waktu_mulai' => $_POST['waktu_mulai'],
        ':waktu_akhir' => $_POST['waktu_akhir'],
        ':kode_presensi' => $_POST['kode_presensi']
    ));

    if (!empty($result)) {
        header("location: ../presensi.php?id=" . $_POST['kode_kelas']);
    }
} else {
    header("location: ../index.php");
}
