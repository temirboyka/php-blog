<?php 
	session_start();
	include_once('functions.php');

	// admin bo'lib kirilmagan bo'lsa chiqib ketish
	if (!isset($_SESSION['user'])) {
		die();
	}

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];

	$sorov = 'delete from maqolalar where id_maqola='.$id;
	$result = queryMysql($sorov);

		if ($result) {
			echo "Maqola o'chrildi. id_maqola=".$id;
			echo "<br><a href='list.php'>Maqolalar ro`yxatiga o`tish</a>";
		}
	}

	$connection->close();
?>