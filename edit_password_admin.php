<?php
session_start();
if (empty($_SESSION['login_user']))
    header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style/adduser_style.css" />
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
                    <a href="user.php">
                        <i class='bx bx-user'></i>
                        <span class="links_name">User</span>
                    </a>
                    <span class="tooltip">User</span>
                </li>
            </div>
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
        <div class="uppertittle-section">User</div>
        <!-- Header Judul -->
        <div class="header-title1">
            <h3>Change Password - Admin</h3>
        </div>

        <!-- Sisi Kiri -->
        <div class="form-container">
            <div class="padtab">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#data-pribadi">Password</a>
                    </li>
                </ul>
            </div>

            <?php
            require_once("logic/koneksi.php");
            ?>

            <div class="tab-content">
                <!-- Form Data Pribadi -->
                <div id="data-pribadi" class="tab-pane fade in active">
                    <form action="logic/edit_password_admin_query.php" id="form-data" class="form-block" method="post">
                        <div class="full-width">
                            <div class="half-width">
                                <div class="col-full">
                                    <label for="password_lama">Masukkan Password Lama</label>
                                    <input type="password" id="password_old" name="password_old" placeholder="Masukan password lama" class="input-field" required />
                                    <span style="color: red;"><?php echo $_SESSION['wrong'] ?? '';
                                                                unset($_SESSION['wrong']); ?>
                                    </span>
                                </div>
                                <div class="col-full">
                                    <label for="password_lama">Masukkan Password Baru</label>
                                    <input type="password" id="password_new" name="password_new" placeholder="Masukan password baru" class="input-field" onkeyup='check();' required />
                                </div>
                                <div class="col-full">
                                    <label for="retype-pasword">Re-Type Password Baru</label>
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Masukan kembali password baru" class="input-field" onkeyup='check();' required />
                                    <span id='message'></span>
                                </div>
                                <div class="box-mid">
                                    <input id="save_update" name="save_update" type="submit" class="btn-simpan" value="Change Password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- Sisi Kanan -->

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

        var check = function() {
            var password = document.getElementById('password_new').value;
            var confirm_password = document.getElementById('confirm_password').value;
            const button = document.getElementById('save_update')
            if (password ==
                confirm_password) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'Matching';
                button.disabled = false;
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Not matching';
                button.disabled = true;
            }
        }
    </script>


</body>

</html>