<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");
    $x = 0;
    while ($x == 0) {
        $id = "P" . rand(100000000, 999999999);

        $sql = $pdo_conn->prepare('SELECT kode_presensi FROM presensi WHERE kode_presensi = :kode_presensi');
        $sql->execute(array(
            ':kode_presensi' => $id
        ));
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if (empty($row['kode_presensi'])) {
            $x = 1;
        }
    }

    $sql = $pdo_conn->prepare("INSERT INTO presensi (kode_presensi, pertemuan, waktu_mulai, waktu_akhir, kode_kelas) 
    VALUES (:kode_presensi, :pertemuan, :waktu_mulai, :waktu_akhir, :kode_kelas)");
    $result = $sql->execute(array(
        ':kode_presensi' => $id,
        ':pertemuan' => $_POST['pertemuan'],
        ':waktu_mulai' => $_POST['waktu_mulai'],
        ':waktu_akhir' => $_POST['waktu_akhir'],
        ':kode_kelas' => $_POST['kode_kelas']
    ));

    $mhs = $pdo_conn->prepare("SELECT nim_mahasiswa FROM mahasiswa");
    $mhs->execute();
    $result_mhs = $mhs->fetchAll();
    $status = 'Tanpa Keterangan';
    if (!empty($result_mhs)) {
        foreach ($result_mhs as $row_mhs) {
            $x = 0;
            while ($x == 0) {
                $id_status = "S" . rand(100000000, 999999999);

                $sql_status = $pdo_conn->prepare('SELECT kode_status_presensi FROM status_presensi WHERE kode_status_presensi = :kode_status_presensi');
                $sql_status->execute(array(
                    ':kode_status_presensi' => $id_status
                ));
                $row_status = $sql_status->fetch(PDO::FETCH_ASSOC);
                if (empty($row_status['kode_presensi'])) {
                    $x = 1;
                }
            }

            $sql = $pdo_conn->prepare("INSERT INTO status_presensi (kode_status_presensi, status_presensi, nim_mahasiswa, kode_presensi) 
    VALUES (:kode_status_presensi, :status_presensi, :nim_mahasiswa, :kode_presensi)");
            $result = $sql->execute(array(
                ':kode_status_presensi' => $id_status,
                ':status_presensi' => $status,
                ':nim_mahasiswa' => $row_mhs['nim_mahasiswa'],
                ':kode_presensi' => $id
            ));
        }
    }

    if (!empty($result)) {
        header("location: ../presensi.php?id=" . $_POST['kode_kelas']);
    }
} else {
    header("location: ../index.php");
}
