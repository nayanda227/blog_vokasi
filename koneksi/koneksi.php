<?php
$koneksi = mysqli_connect("localhost","root","","blog");
// cek koneksi
if (!$koneksi){
  die("Error koneksi: " . mysqli_connect_errno());
}
?>
