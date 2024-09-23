<?php
// Include your database connection file
include('../koneksi/koneksi.php');

// Check if ID is set and valid
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data based on ID
    $sql = "SELECT * FROM user WHERE id_user='$id'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php"); // Redirect to index page if ID is not set or empty
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
                        <h3 class="card-title">Detail User</h3>
                        <table class="table">
                            <tr>
                                <th>Nama:</th>
                                <td><?php echo $row['nama']; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Level:</th>
                                <td><?php echo $row['level']; ?></td>
                            </tr>
                        </table>
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
