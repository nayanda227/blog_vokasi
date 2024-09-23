<?php
// Include your database connection file
include('../koneksi/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    // Insert data into database
    $sql = "INSERT INTO user (nama, email, level) VALUES ('$nama', '$email', '$level')";
    mysqli_query($koneksi, $sql);

    header("Location: index.php"); // Redirect to index page after adding user
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include head.php -->
    <?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Include header.php -->
        <?php include("includes/header.php") ?>
        <!-- Include sidebar.php -->
        <?php include("includes/sidebar.php") ?>

        <div class="content-wrapper">
            <section class="content-header">
                <!-- Content header -->
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Tambah User</h3><br>
                        <form method="post">
                            <div class="form-group">
                                <label>Nama:</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Level:</label>
                                <input type="text" name="level" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <!-- Include footer.php -->
        <?php include("includes/footer.php") ?>
    </div>
    <!-- Include script.php -->
    <?php include("includes/script.php") ?>
</body>
</html>
