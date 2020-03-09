<?php 
$delete_id = $_GET['id'];

$sqlAP = "SELECT * FROM angsuran_pinjaman WHERE id='$delete_id'";
$dataAP = mysqli_fetch_array(mysqli_query($connect, $sqlAP));

$s = $dataAP['angsuran_ke']-1;
$id_pinjam = $dataAP['id_pinjam'];
$sqlUpdateAP = "UPDATE angsuran_pinjaman SET status_angsuran='on' WHERE id_pinjam='$id_pinjam' AND angsuran_ke='$s'";
$sql = "DELETE FROM angsuran_pinjaman WHERE id='$delete_id'";

if(mysqli_query($connect, $sqlUpdateAP) && mysqli_query($connect, $sql)){
	echo "<script> var timer = setTimeout(function() {window.location='/koperasi_sp/login/index.php?page=angsuran_pinjaman'}, 0);</script>";
}else{
	echo "<div class=\"alert alert-danger\" role=\"alert\">Data tidak dapat dihapus, karena pinjaman sudah lunas dibayarkan (data untuk dokumentasi)</div>";
}
 ?>