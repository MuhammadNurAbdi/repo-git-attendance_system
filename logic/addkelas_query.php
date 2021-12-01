<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");
    $x = 0;
    while ($x == 0) {
        $id = "MK" . rand(100, 999);

        $sql = $pdo_conn->prepare('SELECT kode_kelas FROM kelas WHERE kode_kelas = :kode_kelas');
        $sql->execute(array(
            ':kode_kelas' => $id
        ));
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if (empty($row['kode_kelas'])) {
            $x = 1;
        }
    }

    $sql = $pdo_conn->prepare("INSERT INTO kelas (kode_kelas, nama_kelas, hari, jam_awal, jam_akhir, ruang, nip_dosen) 
    VALUES (:kode_kelas, :nama_kelas, :hari, :jam_awal, :jam_akhir, :ruang, :nip)");
    $result = $sql->execute(array(
        ':kode_kelas' => $id,
        ':nama_kelas' => $_POST['InputMatkul'],
        ':hari' => $_POST['InputHari'],
        ':jam_awal' => $_POST['InputJamAwal'],
        ':jam_akhir' => $_POST['InputJamAkhir'],
        ':ruang' => $_POST['InputRuang'],
        ':nip' => $_POST['InputDosen']
    ));
    if (!empty($result)) {
        header("location: ../index.php");
    }
} else {
    header("location: ../index.php");
}
