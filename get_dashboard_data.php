<?php
include 'koneksi.php';

$data = array();

// Pemasukan Hari Ini
$tanggal = date('Y-m-d');
$pemasukan_hari = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_nominal), 0) as total FROM transaksi WHERE transaksi_jenis='Pemasukan' AND transaksi_tanggal='$tanggal'");
$p = mysqli_fetch_assoc($pemasukan_hari);
$data['pemasukan_hari'] = $p['total'];

// Pemasukan Bulan Ini
$bulan = date('m');
$pemasukan_bulan = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_nominal), 0) as total FROM transaksi WHERE transaksi_jenis='Pemasukan' AND MONTH(transaksi_tanggal)='$bulan'");
$p = mysqli_fetch_assoc($pemasukan_bulan);
$data['pemasukan_bulan'] = $p['total'];

// Pemasukan Tahun Ini
$tahun = date('Y');
$pemasukan_tahun = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_nominal), 0) as total FROM transaksi WHERE transaksi_jenis='Pemasukan' AND YEAR(transaksi_tanggal)='$tahun'");
$p = mysqli_fetch_assoc($pemasukan_tahun);
$data['pemasukan_tahun'] = $p['total'];

// Seluruh Pemasukan
$pemasukan_total = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_nominal), 0) as total FROM transaksi WHERE transaksi_jenis='Pemasukan'");
$p = mysqli_fetch_assoc($pemasukan_total);
$data['pemasukan_total'] = $p['total'];

// Pengeluaran Hari Ini
$pengeluaran_hari = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_nominal), 0) as total FROM transaksi WHERE transaksi_jenis='Pengeluaran' AND transaksi_tanggal='$tanggal'");
$p = mysqli_fetch_assoc($pengeluaran_hari);
$data['pengeluaran_hari'] = $p['total'];

// Pengeluaran Bulan Ini
$pengeluaran_bulan = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_nominal), 0) as total FROM transaksi WHERE transaksi_jenis='Pengeluaran' AND MONTH(transaksi_tanggal)='$bulan'");
$p = mysqli_fetch_assoc($pengeluaran_bulan);
$data['pengeluaran_bulan'] = $p['total'];

// Pengeluaran Tahun Ini
$pengeluaran_tahun = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_nominal), 0) as total FROM transaksi WHERE transaksi_jenis='Pengeluaran' AND YEAR(transaksi_tanggal)='$tahun'");
$p = mysqli_fetch_assoc($pengeluaran_tahun);
$data['pengeluaran_tahun'] = $p['total'];

// Seluruh Pengeluaran
$pengeluaran_total = mysqli_query($koneksi, "SELECT COALESCE(SUM(transaksi_nominal), 0) as total FROM transaksi WHERE transaksi_jenis='Pengeluaran'");
$p = mysqli_fetch_assoc($pengeluaran_total);
$data['pengeluaran_total'] = $p['total'];

header('Content-Type: application/json');
echo json_encode($data);
?>
