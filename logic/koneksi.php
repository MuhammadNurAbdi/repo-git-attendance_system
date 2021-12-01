<?php
try {
    $pdo_conn = new PDO(
        //Development Connection
        'mysql:host=localhost;dbname=attendancedb',
        'root',
        '',

        //Remote Database Connection
        // 'mysql:host=remotemysql.com;dbname=dGQZe91J3b',
        // 'dGQZe91J3b',
        // 'kO6GSHkFS8',
        array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => true)
    );
} catch (PDOException $e) {
    print "Koneksi atau query bermasalah: " . $e->getMessage() . "<br/>";
    die();
}
