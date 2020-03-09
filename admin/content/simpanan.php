<?php 
$cont = (isset($_GET["pages"])) ? $_GET["pages"] : "";
	switch ($cont) {
		case 'insert':
			require 'simpanan/insert.php';
			break;
		case 'update':
			require 'simpanan/update.php';
			break;
		case 'delete':
			require 'simpanan/delete.php';
			break;
		case 'cariUsers':
			require 'simpanan/pilih_user.php';
			break;
		default:
			require 'simpanan/list.php';
			break;
	}
 ?>

