<?php 
$delete_id = $_GET['id'];
$sqlAP = "DELETE FROM angsuran_pinjaman WHERE id_pinjam='$delete_id'";
$sql = "DELETE FROM pinjaman WHERE id='$delete_id'";

if(mysqli_query($connect, $sqlAP) && mysqli_query($connect, $sql)){
	echo "<script> var timer = setTimeout(function() {window.location='/koperasi_sp/login/index.php?page=pinjaman'}, 0);</script>";
}else{
	
}
 ?>
