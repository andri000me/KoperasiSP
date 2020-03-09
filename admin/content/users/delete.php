<?php 
$id = $_GET['id'];
$user = $_GET['users'];

if(mysqli_query($connect, "DELETE FROM $user WHERE id='$id'")){
	echo "<div class=\"alert alert-success\" role=\"alert\">Berhasil Dihapus</div>";
	echo "<script>var timer = setTimeout(function() {window.location= '/koperasi_sp/login/index.php?page=users'}, 500)</script>";
}else{
	echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal Dihapus</div>";
	echo "<div class=\"alert alert-warning\" role\"alert\">Tips: Mungkin karena adanya keterkaitan data antara data simpanan, withdraw, pinjaman, angsuran pinjaman, sehingga data tidak dapat dihapus, data tersebut dibutuhkan untuk dokumentasi koperasi</div>";
}
 ?>