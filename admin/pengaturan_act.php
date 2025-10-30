<?php
include '../koneksi.php';

$deskripsi = $_POST['deskripsi'];

if ($_FILES['logo']['name'] != "") {
  $logo = $_FILES['logo']['name'];
  $tmp = $_FILES['logo']['tmp_name'];

  // Cek ekstensi file
  $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
  $x = explode('.', $logo);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['logo']['size'];
  $file_tmp = $_FILES['logo']['tmp_name'];

  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    if ($ukuran < 2048000) { // 2MB
      move_uploaded_file($file_tmp, '../gambar/sistem/' . $logo);

      // Update dengan logo baru
      mysqli_query($koneksi, "UPDATE pengaturan SET pengaturan_deskripsi='$deskripsi', pengaturan_logo='$logo' WHERE pengaturan_id=1");
    } else {
      echo "<script>alert('Ukuran file terlalu besar!');window.location='pengaturan.php';</script>";
      exit;
    }
  } else {
    echo "<script>alert('Ekstensi file tidak diperbolehkan!');window.location='pengaturan.php';</script>";
    exit;
  }
} else {
  // Update tanpa ganti logo
  mysqli_query($koneksi, "UPDATE pengaturan SET pengaturan_deskripsi='$deskripsi' WHERE pengaturan_id=1");
}

header("location:pengaturan.php?alert=sukses");
?>
