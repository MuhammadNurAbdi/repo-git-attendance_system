<?php
session_start();
if (empty($_SESSION['login_user']))
    header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style/user_style.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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

    <section class="home-section">
        <div class="uppertittle-section">User</div>

        <section class="opsi-user">
            <div class="user">
                <a href="list_mahasiswa.php">
                    <div class="icon"><img src="image/mahasiswa.png"></div>
                    <div class="text">Mahasiswa</div>
                </a>
            </div>
            <div class="user">
                <a href="list_dosen.php">
                    <div class="icon"><img src="image/dosen.png"></div>
                    <br>
                    <div class="text">Dosen</div>
                </a>
            </div>
            <div class="user">
                <a href="adduser.php">
                    <br>
                    <div class="icon"><img src="image/tambah.png" width="48%"></div>
                    <br>
                    <div class="text">Tambah User</div>
                </a>
            </div>

        </section>

    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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