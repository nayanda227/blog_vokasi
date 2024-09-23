<?php include_once("koneksi/koneksi.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <?php include_once("include/head.php"); ?>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <?php include_once("include/nav.php"); ?>
    </nav>
    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">BLOG ARCHIVE</h1>
      </div>
    </section><br><br>
    <section id="blog-list">
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-9 blog-main">
            <?php 
            if(isset($_GET['date'])){
                $archive_date = $_GET['date'];
                $sql_blog = "SELECT `b`.`id_blog`, `b`.`judul`, DATE_FORMAT(`b`.`tanggal`, '%d-%m-%Y') AS `tanggal`, 
                                 `k`.`kategori_blog`, `b`.`isi`, `u`.`nama` 
                             FROM `blog` `b`
                             INNER JOIN `kategori_blog` `k`
                             ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog`
                             INNER JOIN `user` `u`
                             ON `b`.`id_user` = `u`.`id_user`
                             WHERE DATE_FORMAT(`b`.`tanggal`, '%M %Y') = ?
                             ORDER BY `b`.`id_blog` DESC";
                $stmt = $koneksi->prepare($sql_blog);
                $stmt->bind_param('s', $archive_date);
                $stmt->execute();
                $result = $stmt->get_result();
                while($data_blog = $result->fetch_assoc()){
            ?>
            <div class="blog-post">
              <h2 class="blog-post-title"><a href="detailblog.php?id=<?php echo $data_blog['id_blog']; ?>"><?php echo htmlspecialchars($data_blog['judul']); ?></a></h2>
              <p class="blog-post-meta"><?php echo htmlspecialchars($data_blog['tanggal']); ?> by <a href="#"><?php echo htmlspecialchars($data_blog['nama']); ?></a></p>
              <p><?php echo htmlspecialchars(substr($data_blog['isi'], 0, 200)); ?>...</p>
              <a href="detailblog.php?id=<?php echo $data_blog['id_blog']; ?>" class="btn btn-primary stretched-link">Continue reading..</a>
            </div><!-- /.blog-post --><br><br>
            <?php 
                } 
            } else {
                echo "No posts found for this archive date.";
            }
            ?>
          </div><!-- /.blog-main -->

          <aside class="col-md-3 blog-sidebar">
            <div class="p-4">
              <h4 class="font-italic">Categories</h4>
              <ol class="list-unstyled mb-0">
                <?php 
                $sql_k = "SELECT `id_kategori_blog`,`kategori_blog` 
                          FROM `kategori_blog`
                          ORDER BY `kategori_blog`";
                $query_k = mysqli_query($koneksi, $sql_k);
                while($data_k = mysqli_fetch_row($query_k)){
                    $id_kat = $data_k[0];
                    $nama_kat = $data_k[1];
                ?>
                <li><a href="daftar_blog.php?data=<?php echo $id_kat; ?>"><?php echo htmlspecialchars($nama_kat); ?></a></li>
                <?php }?>
              </ol>
            </div>

            <div class="p-4">
              <h4 class="font-italic">Archives</h4>
              <ol class="list-unstyled mb-0">
                <?php 
                $sql_archive = "SELECT DISTINCT DATE_FORMAT(tanggal, '%M %Y') AS archive_date 
                                FROM `blog` 
                                ORDER BY archive_date DESC";
                $query_archive = mysqli_query($koneksi, $sql_archive);
                while($data_archive = mysqli_fetch_assoc($query_archive)){
                ?>
                <li><a href="archive_blog.php?date=<?php echo urlencode($data_archive['archive_date']); ?>"><?php echo htmlspecialchars($data_archive['archive_date']); ?></a></li>
                <?php } ?>
              </ol>
            </div>

            <div class="p-4">
              <h4 class="font-italic">Tag</h4>
              <ol class="list-unstyled">
                <?php 
                $sql_t = "SELECT `id_tag`, `tag` FROM `tag` ORDER BY `tag`";
                $query_t = mysqli_query($koneksi, $sql_t);
                while($data_t = mysqli_fetch_assoc($query_t)){
                    $id_tag = $data_t['id_tag'];
                    $nama_tag = $data_t['tag'];
                ?>
                <li><a href="tag.php?data=<?php echo $id_tag; ?>"><?php echo htmlspecialchars($nama_tag); ?></a></li>
                <?php } ?>
              </ol>
            </div>
          </aside><!-- /.blog-sidebar -->
        </div><!-- /.row -->
      </main><!-- /.container -->
    </section><br><br>
    <footer class="bg-primary text-dark">
      <?php include_once("include/footer.php"); ?>
    </footer>
  </body>
</html>
