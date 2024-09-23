<?php
include_once("koneksi/koneksi.php");
?>
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
      <h1 class="text-white">BLOG CATEGORIES</h1>
    </div>
  </section><br><br>
  <section id="blog-list">
    <main role="main" class="container">
      <div class="row">
        <div class="col-md-9 blog-main">
          <?php
          // Memastikan parameter id_kategori_blog ada dan aman
          if (isset($_GET['data']) && is_numeric($_GET['data'])) {
              $id_kategori_blog = $_GET['data'];

              // Query untuk mengambil daftar blog berdasarkan id_kategori_blog
              $sql = "SELECT `b`.`id_blog`, `b`.`judul`, DATE_FORMAT(`b`.`tanggal`, '%d-%m-%Y') AS `tanggal`, 
                             `k`.`kategori_blog`, `b`.`isi`, `u`.`nama` 
                      FROM `blog` `b`
                      INNER JOIN `kategori_blog` `k`
                      ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog`
                      INNER JOIN `user` `u`
                      ON `b`.`id_user` = `u`.`id_user`
                      WHERE `b`.`id_kategori_blog` = ?
                      ORDER BY `b`.`id_blog` DESC";

              // Menyiapkan statement
              $stmt = $koneksi->prepare($sql);
              $stmt->bind_param('i', $id_kategori_blog);
              $stmt->execute();
              $result = $stmt->get_result();

              // Memeriksa apakah ada blog yang ditemukan
              if ($result->num_rows > 0) {
                  // Menampilkan daftar blog
                  while ($data_blog = $result->fetch_assoc()) {
                      ?>
                      <div class="blog-post">
                          <h2 class="blog-post-title"><a href="detailblog.php?id=<?php echo $data_blog['id_blog']; ?>"><?php echo htmlspecialchars($data_blog['judul']); ?></a></h2>
                          <p class="blog-post-meta"><?php echo htmlspecialchars($data_blog['tanggal']); ?> by <a href="#"><?php echo htmlspecialchars($data_blog['nama']); ?></a></p>
                          <p><?php echo htmlspecialchars(substr($data_blog['isi'], 0, 200)); ?>...</p>
                          <a href="detailblog.php?id=<?php echo $data_blog['id_blog']; ?>" class="btn btn-primary stretched-link">Continue reading..</a>
                      </div><br><br><!-- /.blog-post -->
                      <?php
                  }
              } else {
                  // Menampilkan pesan jika tidak ada blog ditemukan
                  echo "<p>No blog posts found for this category.</p>";
              }
              $stmt->close();
          } else {
              // Menampilkan pesan jika parameter id_kategori_blog tidak valid
              echo "<p>Invalid category ID.</p>";
          }
          ?>
        </div><!-- /.blog-main -->

        <aside class="col-md-3 blog-sidebar">
          <div class="p-4">
            <h4 class="font-italic">Categories</h4>
            <ol class="list-unstyled mb-0">
              <?php 
              $sql_k = "SELECT `id_kategori_blog`, `kategori_blog` FROM `kategori_blog` ORDER BY `kategori_blog`";
              $query_k = mysqli_query($koneksi, $sql_k);
              while($data_k = mysqli_fetch_assoc($query_k)){
                  $id_kat = $data_k['id_kategori_blog'];
                  $nama_kat = $data_k['kategori_blog'];
              ?>
              <li><a href="daftar_blog.php?data=<?php echo $id_kat; ?>"><?php echo htmlspecialchars($nama_kat); ?></a></li>
              <?php }?>
            </ol>
          </div>

          <div class="p-4">
            <h4 class="font-italic">Archives</h4>
            <ol class="list-unstyled mb-0">
              <?php 
              // Generate the archive list dynamically based on blog post dates
              $sql_archive = "SELECT DISTINCT DATE_FORMAT(tanggal, '%M %Y') AS archive_date FROM `blog` ORDER BY archive_date DESC";
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
