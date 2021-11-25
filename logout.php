<?php
session_start(); //memulai session
session_destroy(); //hapus session
header("location: login.php");
