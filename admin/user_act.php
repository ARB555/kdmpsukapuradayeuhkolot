<?php
include '../koneksi.php';
$nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = md5($_POST['password']);
$level = mysqli_real_escape_string($koneksi, $_POST['level']);

$rand = rand();
$allowed =  array('gif', 'png', 'jpg', 'jpeg');
$filename = $_FILES['foto']['name'];

if ($filename == "") {
	mysqli_query($koneksi, "insert into user (user_nama, user_username, user_password, user_level, user_foto) values ('$nama','$username','$password','$level','')");
	header("location:user.php");
} else {
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if (!in_array($ext, $allowed)) {
		header("location:user.php?alert=gagal");
	} else {
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/' . $rand . '_' . $filename);
		$file_gambar = mysqli_real_escape_string($koneksi, $rand . '_' . $filename);
		mysqli_query($koneksi, "insert into user (user_nama, user_username, user_password, user_level, user_foto) values ('$nama','$username','$password','$level','$file_gambar')");
		header("location:user.php");
	}
}
