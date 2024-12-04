<?php
// Mulai sesi
session_start();

// Hapus sesi
session_destroy();

// Arahkan kembali ke halaman login
header("Location: landingpage.php");
exit;
?>
