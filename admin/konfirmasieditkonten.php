<?php 
session_start();
include('../koneksi/koneksi.php');
if(isset($_SESSION['id_konten'])){
    $id_konten = $_SESSION['id_konten'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
 
   if(empty($judul)){
       header("Location:editkonten.php?data=".$id_konten."&notif=editkosong");
  }else{
    $sql = "UPDATE `konten` set 
    `judul`='$judul',`isi`='$isi'
    WHERE `id_konten`='$id_konten'";
	mysqli_query($koneksi,$sql);
	unset($_SESSION['id_konten']);
	header("Location:konten.php?notif=editberhasil");
  }
}
?>