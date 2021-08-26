<header>
	<h1>Bu yozuv chiqmaydi</h1>
	<nav>
		<ul>
			<li><a href="<?php  echo SITE;?>" class="current">Bosh sahifa</a></li>
		<?php 			
			$sorov = 'select * from menu';
			$result = queryMysql($sorov);
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<li><a href='?bolim=".$row['id_menu']."'>"
			.$row['nomi']."</a></li>";
								
			}
		 ?>	
		    <li><a href="?bolim=6">Dasturlar</a></li>		
			<li><a href="?bolim=55">Rasmlar</a></li>
			<li><a href="?bolim=0">Aloqa</a></li>
		</ul>
	</nav>
</header>