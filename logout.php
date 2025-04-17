<?php
session_start();            // WAJIB ada
session_unset();            // Menghapus semua variabel dalam session
session_destroy();          // Menghancurkan session
header('Location: login.php'); // Arahkan balik ke halaman login
exit;
