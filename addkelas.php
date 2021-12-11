<?php
session_start();
if (empty($_SESSION['login_user']))
    header('location: login.php');
if ($_SESSION['level_user'] != "Admin")
    header('location: index.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/addkelas_style.css">
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
                        <?php if ($_SESSION['level_user'] == "Mahasiswa") { ?>
                            <a href="profil_mahasiswa.php">
                            <?php } ?>
                            <i class='bx bx-user'></i>
                            <span class="links_name">User</span>
                            </a>
                            <span class="tooltip">User</span>
            </li>

            <li>
                <?php if ($_SESSION['level_user'] == "Admin") { ?>
                    <a href="edit_password_admin.php">
                    <?php } ?>
                    <?php if ($_SESSION['level_user'] == "Dosen") { ?>
                        <a href="edit_password_dosen.php">
                        <?php } ?>
                        <?php if ($_SESSION['level_user'] == "Mahasiswa") { ?>
                            <a href="edit_password_mahasiswa.php">
                            <?php } ?>
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
                <a href="logic/logout.php">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </li>
        </ul>
    </div>

    <?php


    require_once("logic/koneksi.php");
    $data = $pdo_conn->prepare("SELECT nama_dosen, nip_dosen FROM dosen"); //query untuk mengambil data tabel
    $data->execute();
    $result = $data->fetchall();

    ?>

    <section class="home-section">
        <header style="background-color: black; height: 60px;">
            <div class="uppertittle-section">Kelas Baru
            </div>
        </header>
        <div class="form-body" id="daftar">
            <div class="form-container">
                <div class="title">Tambah Kelas</div>
                <div class="content">
                    <form action="logic/addkelas_query.php" method="post">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Mata Kuliah</span>
                                <input type="text" maxlength="64" placeholder="Masukkan mata kuliah" name="InputMatkul" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Semester</span>
                                <input type="number" min="1" max="14" placeholder="Masukkan Semester" name="InputSemester" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Jam</span>
                                <p>Kelas Mulai</p>
                                <input type="time" name="InputJamAwal" required>
                                <p>Kelas Berakhir</p>
                                <input type="time" name="InputJamAkhir" required>

                            </div>
                            <div class="input-box">
                                <span class="details">Ruang Kelas</span>
                                <select name="InputRuang" required>
                                    <option value="">-- Pilih Ruang Kelas --</option>
                                    <option value="A15">A15</option>
                                    <option value="A14">A14</option>
                                    <option value="Lab Jarkom">Lab Jarkom</option>
                                    <option value="Lab RPL">Lab RPL</option>
                                    <option value="B1">B1</option>
                                </select>
                            </div>
                            <div class="input-box">
                                <span class="details">Dosen Pengampu</span>
                                <select name="InputDosen" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    <?php
                                    if (!(empty($result))) {
                                        foreach ($result as $row) { ?>
                                            <option value="<?php echo $row['nip_dosen'] ?>"><?php echo $row['nip_dosen'] ?> - <?php echo $row['nama_dosen'] ?></option>
                                    <?php }
                                    } ?>

                                </select>
                            </div>
                        </div>

                        <div class="button">
                            <a href="index.php" style="margin: 3px; ">Cancel</a>
                            <input id="submit" type="submit" value="Daftar" style="margin: 3px;">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
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