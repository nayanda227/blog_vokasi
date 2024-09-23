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
                    <h3><i class="fas fa-user-tie"></i> Data User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar User</h3>
                <div class="card-tools">
                    <a href="tambahuser.php" class="btn btn-sm btn-info float-right">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="30%">Nama</th>
                        <th width="30%">Email</th>
                        <th width="20%">Level</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include your database connection file
                        include('../koneksi/koneksi.php');
                        
                        // Fetch data from your database table
                        $sql = "SELECT id_user, nama, email, level FROM user";
                        $result = mysqli_query($koneksi, $sql);
                        $no = 1;
                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <td align="center">
                                <a href="edituser.php?id=<?php echo $row['id_user']; ?>" class="btn btn-xs btn-info" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="detailuser.php?id=<?php echo $row['id_user']; ?>" class="btn btn-xs btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="deleteuser.php?id=<?php echo $row['id_user']; ?>" class="btn btn-xs btn-warning" onclick="return confirm('Are you sure you want to delete this user?');" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>                         
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>  
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
