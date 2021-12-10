<?php
session_start();
require_once("logic/koneksi.php");
if (empty($_SESSION['login_user']))
    header('location: login.php');
if ($_SESSION['level_user'] != "Admin")
    header('location: index.php');
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
        <!-- Header Judul -->
        <div class="header-title1">
            <h3>Edit User - Dosen</h3>
        </div>

        <!-- Sisi Kiri -->
        <div class="form-container">
            <div class="padtab">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#data-pribadi">Biodata Pribadi</a>
                    </li>
                </ul>
            </div>

            <?php
            $data = $pdo_conn->prepare("SELECT * FROM dosen WHERE nip_dosen=" . $_GET["nip"]); //query untuk mengambil data tabel
            $data->execute();
            $result = $data->fetchAll();

            $data_akun = $pdo_conn->prepare("SELECT * FROM akun WHERE username=" . $_GET["nip"]); //query untuk mengambil data tabel
            $data_akun->execute();
            $result_akun = $data_akun->fetchAll();
            ?>

            <div class="tab-content">
                <!-- Form Data Pribadi -->
                <div id="data-pribadi" class="tab-pane fade in active">
                    <form action="logic/edit_dosen_query.php?nip=<?php echo $_GET["nip"]; ?>" id="form-data" class="form-block" method="post">
                        <div class="full-width">
                            <div class="half-width">
                                <div class="col-full">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" maxlength="25" name="nama" placeholder="Masukan Nama" class="input-field" value="<?php echo $result[0]["nama_dosen"]; ?>" required />
                                </div>
                                <div class="col-full">
                                    <label for="no_nip">NIP</label>
                                    <input id="nip" type="text" onkeyup="checkDup();" maxlength="18" name="nip" placeholder="Masukan NIP" class="input-field" value="<?php echo $result[0]["nip_dosen"]; ?>" required />
                                    <span id='message_nip'></span>
                                </div>
                                <div class="col-full">
                                    <label for="nama_email">E-mail</label>
                                    <input type="email" maxlength="254" name="email" placeholder="Masukan E-mail" class="input-field" value="<?php echo $result[0]["email_dosen"]; ?>" required />
                                </div>
                                <div class="col-full">
                                    <label for="gender">Jenis Kelamin</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="inlineRadio1" value="Laki-laki" required <?php
                                                                                                                        if ($result[0]['gender_dosen'] == "Laki-laki")
                                                                                                                            echo "checked"
                                                                                                                        ?> />
                                        Laki-laki
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="inlineRadio2" value="Perempuan" <?php
                                                                                                                if ($result[0]['gender_dosen'] == "Perempuan")
                                                                                                                    echo "checked"
                                                                                                                ?> />
                                        Perempuan
                                    </label>
                                </div>
                                <div class="col-full">
                                    <label for="password_lama">Masukkan Password</label>
                                    <input type="password" maxlength="255" id="password" name="password" placeholder="Masukan Password" class="input-field" onkeyup='check();' value="<?php echo $result_akun[0]["password"]; ?>" required />
                                </div>
                                <div class="col-full">
                                    <label for="retype-pasword">Re-Type Password</label>
                                    <input type="password" maxlength="255" id="confirm_password" name="confirm_password" placeholder="Masukan kembali password" class="input-field" onkeyup='check();' value="<?php echo $result_akun[0]["password"]; ?>" required />
                                    <span id='message'></span>
                                </div>
                            </div>
                            <div class="half-width">
                                <div class="col-full">
                                    <label for="alamat">Alamat Tinggal Saat ini</label>
                                    <textarea class="textarea-field" maxlength="255" name="alamat" id="textarea" required><?php echo $result[0]["alamat_dosen"]; ?></textarea>
                                </div>
                                <div class="col-full">
                                    <label for="nama_fakultas">Fakultas</label>
                                    <input type="text" name="fakultas" maxlength="20" placeholder="Masukan nama Fakultas" class="input-field" value="<?php echo $result[0]["fakultas_dosen"]; ?>" required />
                                </div>
                                <div class="col-full">
                                    <label for="nama_prodi">Program Studi</label>
                                    <input type="text" name="prodi" maxlength="30" placeholder="Masukan Nama Prodi" class="input-field" value="<?php echo $result[0]["prodi_dosen"]; ?>" required />
                                </div>
                            </div>
                            <div class="box-mid">
                                <input id="save_update" name="save_update" type="submit" class="btn-simpan" value="Simpan">
                                <a href="list_dosen.php" class="btn-batal">Batal</a>
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
            var password = document.getElementById('password').value;
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

        function checkDup() {
            <?php
            $data_nip = $pdo_conn->prepare("SELECT nip_dosen, username FROM dosen JOIN akun"); //query untuk mengambil data tabel
            $data_nip->execute();
            ?>

            var nip_data = <?php echo json_encode($data_nip->fetchall()); ?>;
            var nip = document.getElementById('nip').value;
            const button = document.getElementById('save_update');
            var BreakException = {};
            if (nip_data && nip != <?php echo $_GET["nip"]; ?>) {
                try {
                    nip_data.forEach(row => {

                        if (nip === row["nip_dosen"] || nip === row["username"]) {
                            document.getElementById('message_nip').style.color = 'red';
                            document.getElementById('message_nip').innerHTML = 'NIP sudah terdaftar!';
                            button.disabled = true;
                            throw BreakException;
                        } else {
                            document.getElementById('message_nip').innerHTML = '';
                            button.disabled = false;
                        }
                    });
                } catch (e) {
                    if (e !== BreakException) throw e;
                }
            } else {
                document.getElementById('message_nip').innerHTML = '';
                button.disabled = false;
            }
        }
    </script>


</body>

</html>