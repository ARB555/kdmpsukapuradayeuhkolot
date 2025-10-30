<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "keuangan";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    //echo "Koneksi berhasil!";
}
?>