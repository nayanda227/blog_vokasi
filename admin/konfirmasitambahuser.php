<?php 
include('../koneksi/koneksi.php');
$user = $_POST['user'];
if(empty($user)){
	header("Location:tambahuser.php?notif=tambahkosong");
}else{
	$sql = "insert into `user` (`user`) 
	values ('$user')";
	mysqli_query($koneksi,$sql);
	header("Location:user.php?notif=tambahberhasil");	
}
?>
