<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "daftar_db";

try {
    $koneksi = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>