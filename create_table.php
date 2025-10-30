<?php
include 'koneksi.php';

$query = "CREATE TABLE IF NOT EXISTS pengaturan (
  pengaturan_id int(11) NOT NULL AUTO_INCREMENT,
  pengaturan_deskripsi text NOT NULL,
  pengaturan_logo varchar(255) NOT NULL,
  PRIMARY KEY (pengaturan_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($koneksi, $query)) {
  echo "Tabel pengaturan berhasil dibuat.<br>";
} else {
  echo "Error creating table: " . mysqli_error($koneksi) . "<br>";
}

$insert = "INSERT INTO pengaturan (pengaturan_id, pengaturan_deskripsi, pengaturan_logo) VALUES (1, 'Selamat datang di Sistem Informasi Keuangan. Sistem ini membantu Anda mengelola keuangan dengan mudah dan efisien.', 'logo.png') ON DUPLICATE KEY UPDATE pengaturan_deskripsi=VALUES(pengaturan_deskripsi), pengaturan_logo=VALUES(pengaturan_logo);";

if (mysqli_query($koneksi, $insert)) {
  echo "Data default berhasil dimasukkan.";
} else {
  echo "Error inserting data: " . mysqli_error($koneksi);
}
?>
