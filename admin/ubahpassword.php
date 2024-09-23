<?php
session_start();
include('../koneksi/koneksi.php');

// Mendapatkan id pengguna dari sesi
$id_user = $_SESSION['id_user'];

// Query untuk mengambil password lama dari database berdasarkan id pengguna
$sql = "SELECT password FROM user WHERE id_user = '$id_user'";
$result = mysqli_query($koneksi, $sql);

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
    // Memeriksa apakah ada hasil dari query
    if (mysqli_num_rows($result) > 0) {
        // Mengambil baris hasil query
        $row = mysqli_fetch_assoc($result);
        // Mendapatkan password lama dari hasil query
        $password_lama = $row['password'];
    } else {
        // Password lama tidak ditemukan
        echo "Password lama tidak ditemukan.";
    }
} else {
    // Kesalahan saat mengeksekusi query
    echo "Error: " . mysqli_error($koneksi);
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>
<?php include("includes/sidebar.php") ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3><i class="fas fa-lock"></i> Ubah Password</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Ubah Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="proses_ubah_password.php" method="post">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama" value="<?php echo $password_lama; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
</body>
</html>
