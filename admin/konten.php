<?php 
include('../koneksi/koneksi.php');
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-file-alt"></i> Konten</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Konten</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Konten</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="" action="">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div>
                <br>
              <div class="col-sm-12">
              <?php if(!empty($_GET['notif'])){?>
                      <?php if($_GET['notif']=="tambahberhasil"){?>
                          <div class="alert alert-success" role="alert">
                              Data Berhasil Ditambahkan</div>
                      <?php } else if($_GET['notif']=="editberhasil"){?>
                          <div class="alert alert-success" role="alert">
                              Data Berhasil Diubah</div>
                    <?php } ?>
                <?php }?>
              </div>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="50%">Judul</th>
                      <th width="30%">Tanggal</th>
                      <th width="15%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                     $batas = 2;
                     if(!isset($_GET['halaman'])){
                          $posisi = 0;
                          $halaman = 1;
                     }else{
                          $halaman = $_GET['halaman'];
                          $posisi = ($halaman-1) * $batas;
                     }                   
                     $sql_b = "SELECT `b`.`id_konten`, `b`.`Judul`,     
                                DATE_FORMAT(`tanggal`, '%d-%m-%Y') 
                                FROM `konten` `b`";
                      $katakunci_konten = "";
                      if (isset($_GET["katakunci"])){
                      $katakunci_konten = $_GET["katakunci"];
                      $sql_b .= " WHERE `b`.`Judul` LIKE '%$katakunci_konten%'";
                     } 
                      $sql_b .= " ORDER BY `b`.`Judul` LIMIT $posisi, $batas";
                      $query_b = mysqli_query($koneksi,$sql_b);
                      $no =$posisi+1;
                      while($data_b = mysqli_fetch_row($query_b)){
                        $id_konten = $data_b[0];
                        $judul = $data_b[1];
                        $tanggal = $data_b[2];
                        ?>
                    <tr>
                    <td><?php echo $no;?></td>
                        <td><?php echo $judul;?></td>
                        <td><?php echo $tanggal;?></td>
                        <td align="center">
                        <a href="editkonten.php?data=<?php echo $id_konten;?>" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="detailkonten.php?data=<?php echo $id_konten;?>" class="btn btn-xs btn-info" title="Detail">
                        <i class="fas fa-eye"></i></a>                        
                        </td>
                      </td>
                    </tr>
                    <?php $no++;}?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <?php
              //hitung jumlah semua data 
              $sql_jum = "SELECT `id_konten`, `Judul` FROM `konten` "; 
              if (isset($_GET["katakunci"])){
                $katakunci_konten = $_GET["katakunci"];
                $sql_jum .= " WHERE `Judul` LIKE '%$katakunci_konten%'";
              } 
              $query_jum = mysqli_query($koneksi,$sql_jum);
              $jum_data = mysqli_num_rows($query_jum);
              $jum_halaman = ceil($jum_data/$batas);
              ?>

              <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <?php 
                    if($jum_halaman==0){
                      //tidak ada halaman
                    }else if($jum_halaman==1){
                      echo "<li class='page-item'><a class='page-link'>1</a></li>";
                    }else{
                      $sebelum = $halaman-1;
                      $setelah = $halaman+1;
                      if (isset($_GET["katakunci"])){
                          $katakunci_konten = $_GET["katakunci"];
                          if($halaman!=1){
                              echo "<li class='page-item'>
                              <a class='page-link' 
                              href='konten.php?katakunci=$katakunci_konten&halaman=1'>First</a></li>";
                              echo "<li class='page-item'><a class='page-link' 
                              href='konten.php?katakunci=$katakunci_konten&halaman=$sebelum'>
                              «</a></li>";
                          }
                          for($i=1; $i<=$jum_halaman; $i++){
                            if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                               if($i!=$halaman){
                                  echo "<li class='page-item'><a class='page-link' 
                                  href='konten.php?katakunci=$katakunci_konten&halaman=$i'>
                                  $i</a></li>";
                               }else{
                                  echo "<li class='page-item'>
                                  <a class='page-link'>$i</a></li>";
                               }
                             }
                         }                         
                            if($halaman!=$jum_halaman){
                              echo "<li class='page-item'>
                              <a class='page-link'  
                              href='konten.php?katakunci=$katakunci_konten&halaman=$setelah'>»</a></li>";
                              echo "<li class='page-item'><a class='page-link' 
                              href='konten.php?katakunci=katakunci_konten&halaman=$jum_halaman'>
                              Last</a></li>";
                            }
                        }else{
                          if($halaman!=1){
                            echo "<li class='page-item'><a class='page-link' 
                            href='konten.php?halaman=1'>First</a></li>";
                            echo "<li class='page-item'><a class='page-link' 
                            href='konten.php?halaman=$sebelum'>«</a></li>";
                          }
                          for($i=1; $i<=$jum_halaman; $i++){
                            if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                               if($i!=$halaman){
                                  echo "<li class='page-item'><a class='page-link' 
                                  href='konten.php?halaman=$i'>$i</a></li>";
                               }else{
                                  echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                               }
                             }
                         }                         
                            if($halaman!=$jum_halaman){
                              echo "<li class='page-item'><a class='page-link' 
                              href='konten.php?halaman=$setelah'>
                              »</a></li>";
                              echo "<li class='page-item'><a class='page-link' 
                              href='konten.php?halaman=$jum_halaman'>Last</a></li>";
                            }
                            }
                      }?>
                </ul>
              </div>
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