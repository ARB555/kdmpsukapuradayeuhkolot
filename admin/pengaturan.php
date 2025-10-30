<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pengaturan
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengaturan</li>
    </ol>
  </section>

  <section class="content">

    <div class="row">
      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Pengaturan Sistem</h3>
          </div>
          <div class="box-body">

            <?php
            if (isset($_GET['alert'])) {
              if ($_GET['alert'] == "sukses") {
                echo "<div class='alert alert-success'>Pengaturan berhasil diperbarui!</div>";
              }
            }
            ?>

            <?php
            $pengaturan = mysqli_query($koneksi, "SELECT * FROM pengaturan WHERE pengaturan_id=1");
            $p = mysqli_fetch_assoc($pengaturan);
            ?>

            <form action="pengaturan_act.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required><?php echo $p['pengaturan_deskripsi']; ?></textarea>
              </div>

              <div class="form-group">
                <label>Logo Saat Ini</label>
                <br>
                <?php if ($p['pengaturan_logo'] != "") { ?>
                  <img src="../gambar/sistem/<?php echo $p['pengaturan_logo']; ?>" width="200px" class="img-thumbnail">
                <?php } else { ?>
                  <p>Tidak ada logo</p>
                <?php } ?>
              </div>

              <div class="form-group">
                <label>Ganti Logo (Opsional)</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                <small class="help-block">Format: JPG, PNG, GIF. Maksimal 2MB</small>
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

  </section>

</div>

<?php include 'footer.php'; ?>
