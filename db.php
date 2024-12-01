<?php
$host = 'localhost'; // Ganti dengan host database Anda
$dbname = 'infoma'; // Nama database Anda
$username = 'root'; // Username database Anda
$password = ''; // Password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
