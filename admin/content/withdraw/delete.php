<?php 
$delete_id = $_GET['id'];
$sql = "DELETE FROM withdraw WHERE id='$delete_id'";
mysqli_query($connect, $sql);
echo "<script> var timer = setTimeout(function() {window.location='/koperasi_sp/login/index.php?page=withdraw'}, 0);</script>";
 ?>