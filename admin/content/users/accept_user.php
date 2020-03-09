<?php 
$id = $_GET['id'];
$sqli = "INSERT INTO users SELECT * FROM pre_users WHERE id='$id'";
$sqld = "DELETE FROM pre_users WHERE id='$id'";
if(mysqli_query($connect, $sqli)){
	mysqli_query($connect, $sqld);
	echo "<script> var timer = setTimeout(function() {window.location='/koperasi_sp/login/index.php?page=users'}, 0);</script>";
}else{
	echo "<div class=\"alert alert-danger\" role=\"alert\">Gagal disetujui</div>";
}
 ?>