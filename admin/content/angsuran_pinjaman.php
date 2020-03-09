<?php 
$cont = (isset($_GET["pages"])) ? $_GET["pages"] : "";
	switch ($cont) {
		case 'insert':
			require 'angsuran_pinjaman/insert.php';
			break;
		case 'delete':
			require 'angsuran_pinjaman/delete.php';
			break;
		case 'lunasi':
			require 'angsuran_pinjaman/lunasi.php';
			break;
		default:
			require 'angsuran_pinjaman/list.php';
			break;
	}
 ?>

