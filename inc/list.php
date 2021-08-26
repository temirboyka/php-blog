<?php 
	session_start();
	include_once('functions.php');

	// admin bo'lib kirilmagan bo'lsa chiqib ketish
	if (!isset($_SESSION['user'])) {
		die();
	}

	echo "<h2> <a href='".SITE."\admin.php?chiqish=1'>
			Chiqish</a></h2>";

	echo "<h2> <a href='".SITE."\inc\add.php'>
			Yangi maqola qo'shish</a></h2>";		

	$sorov = 'select * from maqolalar order by id_maqola';
	$result = queryMysql($sorov);

	echo "<table border=1 align='center' width='85%'>";
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$id = $row['id_maqola'];
		$sarlavha = $row['m_sarlavha'];

		echo <<<_END
	<tr>
		<td>$id</td>
		<td>$sarlavha</td>
		<td><a href="edit.php?id=$id">Tahrirlash</a></td>
		<td><a href="delete.php?id=$id">O'chirish</a></td>
	</tr>
_END;
	}

	echo "</table>";

	$connection->close();


 ?>