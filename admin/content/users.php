<?php 
$cont = (isset($_GET["pages"])) ? $_GET["pages"] : "";
	switch ($cont) {
		case 'insert':
			require 'users/insert.php';
			break;
		case 'update':
			require 'users/update.php';
			break;
		case 'delete':
			require 'users/delete.php';
			break;
		case 'accept_user':
			require 'users/accept_user.php';
			break;
		default:
			require 'users/list.php';
			break;
	}
 ?>

