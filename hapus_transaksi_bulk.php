<?php
include 'koneksi.php';

// Fungsi untuk menghapus transaksi berdasarkan kondisi dan menyesuaikan saldo bank
function hapus_transaksi($kondisi) {
    global $koneksi;

    // Ambil semua transaksi yang cocok dengan kondisi
    $query = "SELECT * FROM transaksi WHERE $kondisi";
    $result = mysqli_query($koneksi, $query);

    while ($t = mysqli_fetch_assoc($result)) {
        $bank_id = $t['transaksi_bank'];
        $jenis = $t['transaksi_jenis'];
        $nominal = $t['transaksi_nominal'];

        // Ambil saldo bank saat ini
        $rekening = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank_id'");
        $r = mysqli_fetch_assoc($rekening);
        $saldo_sekarang = $r['bank_saldo'];

        // Sesuaikan saldo berdasarkan jenis transaksi
        if ($jenis == "Pemasukan") {
            $total = $saldo_sekarang - $nominal;
        } elseif ($jenis == "Pengeluaran") {
            $total = $saldo_sekarang + $nominal;
        }

        // Update saldo bank
        mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank_id'");
    }

    // Hapus transaksi
    mysqli_query($koneksi, "DELETE FROM transaksi WHERE $kondisi");
}

// Kondisi untuk hari ini
$tanggal_hari_ini = date('Y-m-d');
hapus_transaksi("transaksi_tanggal = '$tanggal_hari_ini'");

// Kondisi untuk bulan ini
$bulan_ini = date('m');
$tahun_ini = date('Y');
hapus_transaksi("MONTH(transaksi_tanggal) = '$bulan_ini' AND YEAR(transaksi_tanggal) = '$tahun_ini'");

// Kondisi untuk tahun ini
hapus_transaksi("YEAR(transaksi_tanggal) = '$tahun_ini'");

// Kondisi untuk seluruh transaksi
hapus_transaksi("1=1"); // 1=1 untuk semua

// Redirect atau pesan sukses
echo "Semua transaksi pemasukan dan pengeluaran telah dihapus.";
?>
