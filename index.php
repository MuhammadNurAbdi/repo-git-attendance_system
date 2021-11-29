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
    <link rel="stylesheet" href="style/index_style.css">
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
                <?php if ($_SESSION['level_user'] == "Admin") { ?>
                    <a href="user.php">
                    <?php } ?>
                    <?php if ($_SESSION['level_user'] == "Dosen") { ?>
                        <a href="profil_dosen.php">
                        <?php } ?>
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

    <section class="home-section">
        <?php if ($_SESSION['level_user'] == "Admin") { ?>
            <div class="text">Dashboard</div>
            <div class="row">
                <?php
                $data = $pdo_conn->prepare("SELECT * FROM kelas ORDER BY nama_kelas ASC"); //query untuk mengambil data tabel
                $data->execute();
                $result = $data->fetchAll();
                //perulangan untuk menampilkan data 

                if (!empty($result)) {
                    foreach ($result as $row) {
                ?>
                        <div class="column">
                            <p id="rcorners1"><?php echo $row["nama_kelas"]; ?></p>
                            <p id="rcorners2"></p>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <a href="addkelas.php">
                <button class="btn-tambah"> Tambah Kelas Baru
                </button>
            </a>
        <?php } ?>

        <?php if ($_SESSION['level_user'] == "Dosen") { ?>
            <div class="text">Dashboard</div>
            <div class="row">
                <?php
                $data = $pdo_conn->prepare("SELECT * FROM kelas WHERE nip_dosen = " . $_SESSION['nip'] . " ORDER BY nama_kelas ASC"); //query untuk mengambil data tabel
                $data->execute();
                $result = $data->fetchAll();
                //perulangan untuk menampilkan data 

                if (!empty($result)) {
                    foreach ($result as $row) {
                ?>
                        <div class="column">
                            <p id="rcorners1"><a href="presensi.php?id=<?php echo $row['kode_kelas'] ?>"><?php echo $row["nama_kelas"]; ?></a></p>
                            <p id="rcorners2"></p>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        <?php } ?>

        <?php if ($_SESSION['level_user'] == "Mahasiswa") { ?>
            <div class="text">Dashboard</div>
            <div class="row">
                <?php
                $data = $pdo_conn->prepare("SELECT * FROM kelas ORDER BY nama_kelas ASC"); //query untuk mengambil data tabel
                $data->execute();
                $result = $data->fetchAll();
                //perulangan untuk menampilkan data 

                if (!empty($result)) {
                    foreach ($result as $row) {
                ?>
                        <div class="column">
                            <p id="rcorners1"><a href="presensi_mhs.php?id=<?php echo $row['kode_kelas'] ?>"><?php echo $row["nama_kelas"]; ?></a></p>
                            <p id="rcorners2"></p>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        <?php } ?>
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