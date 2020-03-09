<?php 
if ($_SESSION['role'] == 'admin') {
	$cont = (isset($_GET["page"])) ? $_GET["page"] : "";
	switch ($cont) {
		case 'users':
			require '../admin/content/users.php';
			break;
		case 'simpanan':
			require '../admin/content/simpanan.php';
			break;
		case 'withdraw':
			require '../admin/content/withdraw.php';
			break;
		case 'pinjaman':
			require '../admin/content/pinjaman.php';
			break;
		case 'angsuran_pinjaman':
			require '../admin/content/angsuran_pinjaman.php';
			break;
		case 'profil':
			require '../admin/content/profil.php';
			break;
		default:
			require '../admin/content/dashboard.php';
			break;
	}
}else{
	$content = (isset($_GET["page"])) ? $_GET["page"] : "";
	switch($content){
		case 'profil':
			require 'content/profil.php';
			break;
		case 'simpanan':
			require 'content/simpanan.php';
			break;
		case 'pinjaman':
			require 'content/pinjaman.php';
			break;
		case 'withdraw':
			require 'content/withdraw.php';
			break;
		case 'angsuran_pinjaman':
			require 'content/angsuran_pinjaman.php';
			break;
		case 'ajukan_pinjaman':
			require 'content/ajukan_pinjaman.php';
			break;
		default:
			require 'content/dashboard.php';
			break;
	}
}
 ?>