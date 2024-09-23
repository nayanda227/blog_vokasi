<?php
// Include your database connection file
include('../koneksi/koneksi.php');

// Check if ID is set and valid
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete user from database
    $sql = "DELETE FROM user WHERE id_user='$id'";
    mysqli_query($koneksi, $sql);

    header("Location: index.php"); // Redirect to index page after deleting user
    exit;
} else {
    header("Location: index.php"); // Redirect to index page if ID is not set or empty
    exit;
}
?>
