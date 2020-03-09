<?php 
$cont = (isset($_GET["pages"])) ? $_GET["pages"] : "";
	switch ($cont) {
		case 'insert':
			require 'withdraw/insert.php';
			break;
		case 'update':
			require 'withdraw/update.php';
			break;
		case 'delete':
			require 'withdraw/delete.php';
			break;
		case 'cariUsers':
			require 'withdraw/pilih_user.php';
			break;
		default:
			require 'withdraw/list.php';
			break;
	}
 ?>

