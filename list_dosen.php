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
    <link rel="stylesheet" href="style/list_style.css">
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

            <li>
                <a href="index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <div class="sidebar-file">
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
            </div>
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

    <section class="home-section" style="background-color: #0C172D;">
        <div class="text" style="color: white;">Dashboard</div>
        <div class="row"></div>
        <p>Daftar Dosen</p>
        <table id="customers">
            <tr>
                <th>NIP</th>
                <th>Nama Dosen</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Fakultas</th>
                <th>Program Studi</th>
                <th colspan="2">Aksi</th>
            </tr>

            <?php
            require_once("logic/koneksi.php");
            $data = $pdo_conn->prepare("SELECT * FROM dosen ORDER BY nama_dosen ASC"); //query untuk mengambil data tabel
            $data->execute();
            $result = $data->fetchAll();
            //perulangan untuk menampilkan data 
            if (!empty($result)) {
                foreach ($result as $row) {
            ?>
                    <tr>
                        <td><?php echo $row["nip_dosen"]; ?></td>
                        <td><?php echo $row["nama_dosen"]; ?></td>
                        <td><?php echo $row["gender_dosen"]; ?></td>
                        <td><?php echo $row["email_dosen"]; ?></td>
                        <td><?php echo $row["alamat_dosen"]; ?></td>
                        <td><?php echo $row["fakultas_dosen"]; ?></td>
                        <td><?php echo $row["prodi_dosen"]; ?></td>
                        <td><a class="button" href='edit_dosen.php?nip=<?php echo $row['nip_dosen']; ?>'>Edit</a></td>
                        <td><a class="button" onclick="return confirmBtn();" href='logic/delete_dosen.php?nip=<?php echo $row['nip_dosen']; ?>'>Delete</a></td>
                    </tr>
            <?php
                }
            }
            ?>
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

        function confirmBtn() {
            if (confirm('Apakah anda yakin ingin menghapus?')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>