<?php
	session_start();
	include_once('functions.php');

	// admin bo'lib kirilmagan bo'lsa chiqib ketish
	if (!isset($_SESSION['user'])) {
		die();
	}
	// o'zgaruvchilarga boshlang'ich qiymat berish
	$m_sarlavhaXato = $m_qisqaXato = $m_kalit_sozXato = $m_matniXato = $m_rasmiXato = "";
	$m_sarlavha = $m_qisqa = $m_kalit_soz = $m_matni = $m_rasmi = "";
	$m_bolim_id = 0;	

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		if (empty($_POST["m_sarlavha"])) {
	    	$m_sarlavhaXato = "Maqola sarlavhasi kiritilmadi";
	  	} else {
	    	$m_sarlavha = strtocode($_POST["m_sarlavha"]);	    	
	  	}

	  	if (empty($_POST["m_qisqa"])) {
	    	$m_qisqaXato = "Maqolaning qisqa shakli kiritilmadi";
	  	} else {
	    	$m_qisqa = strtocode($_POST["m_qisqa"]);	    	
	  	}

	  	if (empty($_POST["m_matni"])) {
	    	$m_matniXato = "Maqolaning matni kiritilmadi";
	  	} else {
	    	$m_matni = strtocode($_POST["m_matni"]);	    	
	  	}

	  	$m_kalit_soz = strtocode($_POST["m_kalit_soz"]);
	  	$m_rasmi = strtocode($_POST["m_rasmi"]);
	  	$m_bolim_id = $_POST["m_bolim_id"];
	  	$id_maqola  = $_POST["id_maqola"];

	  	if (! (	empty($m_sarlavha) 	&&
	  			empty($m_matni)		&&
	  			empty($m_qisqa) )) {
			
			$sorov = "UPDATE  `maqolalar` SET  `m_sarlavha` =  '$m_sarlavha',
			`m_qisqa` =  '$m_qisqa',
			`m_kalit_soz` =  '$m_kalit_soz',
			`m_matni` =  '$m_matni',
			`m_bolim_id` =  $m_bolim_id,
			`m_rasmi` =  '$m_rasmi' 
			WHERE  `maqolalar`.`id_maqola` = $id_maqola";	

			$result = queryMysql($sorov);
			if ($result) {
				die("<h1> Maqola o`zgartirildi. <a href='".SITE."/?maqola=".$id_maqola."'>Maqolani ko`rish</a></h1>");
			}  		
		}
	  	
		    
	} elseif (isset($_GET['id']) &&
			  is_numeric($_GET['id'])) {
	$id_maqola = $_GET['id'];

	$sorov = 'select * from maqolalar 
		  	  where id_maqola='.$id_maqola;

	$result = queryMysql($sorov);
	$row = $result->fetch_array(MYSQLI_ASSOC);

	$m_sarlavha = aslString($row['m_sarlavha']);
	$m_qisqa 	= aslString($row['m_qisqa']);
	$m_matni 	= aslString($row['m_matni']);
	$m_rasmi 	= aslString($row['m_rasmi']);
	$m_kalit_soz = aslString($row['m_kalit_soz']);
	$m_bolim_id = $row['m_bolim_id'];
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Yangi maqola qo'shish</title>
	<!-- CKEditor ga yo'lni to'g'ri berlganini tekshiring -->
    <script src="../editor/ckeditor.js"></script>
	<style type="text/css">
		.qizil{color: red;}
	</style>
</head>
<body>
<form method="post" action="<?php 
		echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<input type="hidden" name="id_maqola" 
	value="<?php echo $id_maqola ?>">

	<p><span class="qizil">*</span> to'ldirish majburiy 
				bo'lgan maydonlar</p>
	<table>
		<tr>			
			<td>
			Maqola sarlavhasi: <br>
<input type="text" name="m_sarlavha" value="<?php echo $m_sarlavha ?>" 
			size = "100"> 
			<span class="qizil">* <?php echo $m_sarlavhaXato;?> </span></td>
		</tr>
		<tr>
			
			<td>Maqolaning qisqa shakli: <br>
<textarea name="m_qisqa" rows="5" cols="100">
<?php echo $m_qisqa; ?></textarea>
				<span class="qizil">* <?php echo $m_qisqaXato;?></span></td>
		</tr>
		<tr>			
			<td> Kalit so'zlarni vergul bilan kiriting: <br>
<input size = "100" type="text" name="m_kalit_soz" value="<?php echo $m_kalit_soz; ?>">
			<span class="qizil"> <?php echo $m_kalit_sozXato; ?> </span></td>
		</tr>
		<tr>			
			<td> Maqola matni: <br>
<textarea name="m_matni" id="editor1" rows="10" cols="100"><?php echo $m_matni; ?></textarea>
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
	CKEDITOR.replace( 'editor1' );
</script>			
			<span class="qizil"> *<?php echo $m_matniXato; ?> </span></td>
		</tr>
		<tr>			
			<td> Maqola rasmiga yo'l ko'rsating: <br>
			<input size = "100" type="text" name="m_rasmi" value="<?php echo $m_rasmi; ?>">
			</td>
		</tr>
		<tr>			
			<td> Maqolani qaysi bo'limga tegishli ekanini tanlang: <br>
<select name="m_bolim_id">

<?php 
	$sorov = 'select * from menu';
	$result = queryMysql($sorov);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		echo "<option value='".$row['id_menu']."'";
		
		if ($row['id_menu'] == $m_bolim_id) {
			echo "selected";
		}
		
		echo ">".$row['nomi']."</option>";
	}
 ?>				
</select>
		</tr>
		
	</table>
	<input type="reset"  value="Tozalash" style="width:120px">
	<input type="submit" value="Yubor" style="width:120px">
</form>	
	<hr>
	
</body>
</html>

