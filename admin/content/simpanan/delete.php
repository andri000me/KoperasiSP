<?php 
$delete_id = $_GET['id'];
$sql = "DELETE FROM simpanan WHERE id='$delete_id'";
mysqli_query($connect, $sql);
echo "<script> var timer = setTimeout(function() {window.location='/koperasi_sp/login/index.php?page=simpanan'}, 0);</script>";
 ?>