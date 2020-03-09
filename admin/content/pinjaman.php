<?php 
$cont = (isset($_GET["pages"])) ? $_GET["pages"] : "";
	switch ($cont) {
		case 'insert':
			require 'pinjaman/insert.php';
			break;
		case 'update':
			require 'pinjaman/update.php';
			break;
		case 'delete':
			require 'pinjaman/delete.php';
			break;
		case 'accept_pinjaman':
			require 'pinjaman/accept_pinjaman.php';
			break;
		case 'cariUsers':
			require 'pinjaman/pilih_user.php';
			break;
		default:
			require 'pinjaman/list.php';
			break;
	}
 ?>

