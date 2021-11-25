<?php
session_start();
require_once("logic/koneksi.php");
if (empty($_SESSION['login_user']))
    header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/presensi_style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxs-calendar-check icon'></i>
            <div class="logo_name">Presensi</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <div class="sidebar-file">
                <li>
                    <a href="index.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
            </div>
            <li>
                <a href="user.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">User</span>
                </a>
                <span class="tooltip">User</span>
            </li>

            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <div class="name_job">
                        <div class="name"><?php echo "$_SESSION[login_user]"; ?></div>
                        <div class="job"><?php echo "$_SESSION[level_user]"; ?></div>
                    </div>
                </div>
                <a href="logout.php">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </li>
        </ul>
    </div>

    <?php
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tahun
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tanggal

        return $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[2];
    }

    $data = $pdo_conn->prepare("SELECT * FROM presensi JOIN kelas USING (kode_kelas) JOIN dosen USING (nip_dosen) 
    WHERE kode_kelas = :kode_kelas
    ORDER BY pertemuan DESC"); //query untuk mengambil data tabel
    $data->execute(array(
        ':kode_kelas' => $_GET['id']
    ));
    $result = $data->fetchAll();

    $kelas = $pdo_conn->prepare("SELECT nama_kelas FROM kelas WHERE kode_kelas = :kode_kelas");
    $kelas->execute(array(
        ':kode_kelas' => $_GET['id']
    ));
    $rowkelas = $kelas->fetchAll();
    ?>
    </div>
    <section class="home-section">
        <div class="uppertittle-section"><?php echo $rowkelas[0]['nama_kelas'] ?><a href="add_presensi.php?id=<?php echo $_GET['id'] ?>" class="btn-add">Tambah Presensi</a></div>
        <div class="row"></div>
        <table id="customers">
            <tr>
                <td colspan="4" class="title">Daftar Pertemuan</td>
            </tr>
            <tr>
                <th>Pertemuan Ke</th>
                <th>Dosen Pengajar</th>
                <th>Waktu Presensi</th>
                <th>Aksi</th>
            </tr>
            <?php
            //perulangan untuk menampilkan data 
            if (!empty($result)) {
                foreach ($result as $row) {
            ?>
                    <tr>
                        <td><?php echo $row['pertemuan'] ?></td>
                        <td><?php echo $row['nama_dosen'] ?></td>
                        <td>PRESENSI MANDIRI<br> Mulai Berlaku<br> <?php echo tgl_indo(date('d-m-Y H:i', strtotime($row['waktu_mulai']))) ?><br> s.d
                            <br> <?php echo tgl_indo(date('d-m-Y H:i', strtotime($row['waktu_akhir']))) ?>
                        </td>
                        <td>
                            <input type="button" onclick="location.href='edit_presensi.php?id=<?php echo $_GET['id'] ?>&presensi=<?php echo $row['kode_presensi'] ?>';" class="btn-edit" value="Edit"><br>
                            <input type="button" onclick="location.href='logic/delete_presensi.php?id=<?php echo $_GET['id'] ?>&presensi=<?php echo $row['kode_presensi'] ?>';" class="btn-hapus" value="Hapus"><br>
                            <input type="button" onclick="location.href='kelolapresensi.php?id=<?php echo $_GET['id'] ?>&presensi=<?php echo $row['kode_presensi'] ?>';" class="btn-cetak" value="Kelola">
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="4">Tidak ada data</td>
                </tr>
            <?php } ?>
        </table>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
            }
        }
    </script>
</body>

</html>