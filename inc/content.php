<?php 
	if (isset($_GET['bolim']) &&
		is_numeric($_GET['bolim'])) {
		
		$bolim = $_GET['bolim'];

	if ($bolim == 6) {
		include('demo.php');
	}

	elseif ($bolim == 55) {
		include('gallery.html');
	} elseif ($bolim == 0) {
		include('inc/aloqa.php');
	} else {

		$sorov = 'select * from maqolalar
				  where `m_bolim_id`='.$bolim;

		$result = queryMysql($sorov);
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<article><figure>";
			echo "<img src='images/".$row['m_rasmi']."'/>";
			echo "<figcaption>".aslString($row['m_sarlavha'])."</figcaption></figure>";
			echo "<hgroup><h2><a href='?maqola=".$row['id_maqola']."'> 
				  ".aslString($row['m_sarlavha'])."</a></h2></hgroup>";
			echo "<p>".aslString($row['m_qisqa']);
			echo " <a href='?maqola=".$row['id_maqola']."'> 
				  davomi ...</a></p></article>";
			
		}
	 }
	} elseif (isset($_POST['comment'])) {
		include('inc/aloqa.php');
		
	} elseif (isset($_GET['maqola']) &&
			  is_numeric($_GET['maqola'])) {
		
		$maqola = $_GET['maqola'];

		$sorov = 'select * from maqolalar
				  where `id_maqola`='.$maqola;

		$result = queryMysql($sorov);
		$row = $result->fetch_array(MYSQLI_ASSOC);

		echo "<article>";
		echo "<h2>".aslString($row['m_sarlavha'])."</h2>";
		echo aslString($row['m_matni']);
		echo "</article>";

		if (!empty($row['m_kalit_soz'])) {
			
				echo "<article>";
			kalit_sozni_chiqarish($row['m_kalit_soz']);
				echo "</article>";
		}
		

		$oqildi = $row['m_oqildi'] + 1;
		$sorov = 'UPDATE  `maqolalar` SET  `m_oqildi` = '.$oqildi. 
				 ' WHERE  `maqolalar`.`id_maqola` = '.$maqola;
		$result = queryMysql($sorov);

	} elseif (isset($_GET['kalit_soz'])) {
		$kalit_soz = sanitizeString($_GET['kalit_soz']);

		qidirish($kalit_soz);
	}

	else {
		$sorov = 'select * from maqolalar
				  order by id_maqola desc 
				  limit 0, 5';

		$result = queryMysql($sorov);
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<article><figure>";
			echo "<img src='images/".$row['m_rasmi']."'/>";
			echo "<figcaption>".aslString($row['m_sarlavha'])."</figcaption></figure>";
			echo "<hgroup><h2><a href='?maqola=".$row['id_maqola']."'> 
				  ".aslString($row['m_sarlavha'])."</a></h2></hgroup>";
			echo "<p>".aslString($row['m_qisqa']);
			echo " <a href='?maqola=".$row['id_maqola']."'> 
				  davomi ...</a></p></article>";
			
		}
	}

	function qidirish($kalit_soz){

		$sorov = 'select * from maqolalar 
				  where `m_matni` like "%'.$kalit_soz.'%"';
		
		$result = queryMysql($sorov);
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		echo "<article><figure>";
		echo "<img src='images/".$row['m_rasmi']."'/>";
		echo "<figcaption>".aslString($row['m_sarlavha'])."</figcaption></figure>";
		echo "<hgroup><h2><a href='?maqola=".$row['id_maqola']."'> 
				  ".aslString($row['m_sarlavha'])."</a></h2></hgroup>";
		echo "<p>".aslString($row['m_qisqa']);
		echo " <a href='?maqola=".$row['id_maqola']."'> 
				  davomi ...</a></p></article>";
		}

		$soni = $result->num_rows;
		if ($soni == 0) {
			$sorov = 'select * from maqolalar 
				  where `m_sarlavha` like "%'.$kalit_soz.'%"';
		
			$result = queryMysql($sorov);
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<article><figure>";
		echo "<img src='images/".$row['m_rasmi']."'/>";
		echo "<figcaption>".aslString($row['m_sarlavha'])."</figcaption></figure>";
		echo "<hgroup><h2><a href='?maqola=".$row['id_maqola']."'> 
				  ".aslString($row['m_sarlavha'])."</a></h2></hgroup>";
		echo "<p>".aslString($row['m_qisqa']);
		echo " <a href='?maqola=".$row['id_maqola']."'> 
				  davomi ...</a></p></article>";
			}
			
			$soni = $result->num_rows;
			if ($soni == 0) {
				echo "<p> Uzr siz qidirgan kalit so`z bo`yicha ma`lumot topilmadi.</p>";
			}
		}
	} // qidirish

	function kalit_sozni_chiqarish($kalit_soz){
		$kalit_soz = trim($kalit_soz);
		$a = explode(',', $kalit_soz);

		//print_r($a);
		foreach ($a as $kalit) {			
			$kalit = trim($kalit);
			$sorov = 'select * from maqolalar 
				  where `m_matni` like "%'.$kalit.'%"';
			$result = queryMysql($sorov);
			$soni = $result->num_rows;
			
			if ($soni != 0) {
				echo "<a href='?kalit_soz=".$kalit."'>".
				$kalit." (".$soni.")</a>";
			} else {
				$sorov = 'select * from maqolalar 
					  where `m_sarlavha` like "%'.$kalit.'%"';
				$result = queryMysql($sorov);
				$soni = $result->num_rows;
				if ($soni != 0) {
					echo "<a href='?kalit_soz=".$kalit."'>".
					$kalit." (".$soni.")</a>";
				}
			}	
		}
	}



 ?>