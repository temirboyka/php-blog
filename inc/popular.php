<section class="popular-recipes">
					<h2>Ko'p o'qilganlar</h2>


					<?php 
				$sorov = 'select * from maqolalar
				  order by m_oqildi DESC
				  limit 0 , 5'; 

		$result = queryMysql($sorov);
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			
			echo " <a href='?maqola=".$row['id_maqola']."'>"
				  .$row['m_sarlavha']."</a>";
				}
			
				?>
					</section>