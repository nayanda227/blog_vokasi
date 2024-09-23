<?php
// Include your database connection file
include('../koneksi/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    // Update data in the database
    $sql = "UPDATE user SET nama='$nama', email='$email', level='$level' WHERE id_user='$id'";
    mysqli_query($koneksi, $sql);

    header("Location: index.php"); // Redirect to index page after updating user
    exit;
}

// Fetch user data based on ID
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id_user='$id'";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
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
                        <h3 class="card-title">Edit User</h3>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id_user']; ?>">
                            <div class="form-group">
                                <label>Nama:</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Level:</label>
                                <input type="text" name="level" class="form-control" value="<?php echo $row['level']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
