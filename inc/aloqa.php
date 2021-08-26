	<?php
	// o'zgaruvchilarga boshlang'ich qiymat berish
	$nameErr = $emailErr = $commentErr = "";
	$name = $email = $comment = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$tekshirish = true;

		if (empty($_POST["name"])) {
	    	$nameErr = "Ism kiritilmadi";
	    	$tekshirish = false;
	  	} else {
	    	$name = sanitizeString($_POST["name"]);
	    	if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = "Faqat harf va probel bo`lishi mumkin"; 
			}
	  	}

	  	if (empty($_POST["email"])) {
		    $emailErr = "Email kiritilmadi";
		    $tekshirish = false;
		  } else {
		    $email = sanitizeString($_POST["email"]);
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $emailErr = "Email noto`g`ri kiritildi"; 
			}
		  }
		 

		  if (empty($_POST["comment"])) {
		    $comment = "";
		    $commentErr = "Xabar kiritilmadi";
		    $tekshirish = false;
		  } else {
		    $comment = sanitizeString($_POST["comment"]);
		  }
		  echo "string " .$tekshirish;
		  if ($tekshirish == true) {
			$sana = date('Y-m-d H:i:s');
			$sorov = "INSERT INTO  `fikr` 
					(`name`, `email`, `xabar`,`sana`)
			VALUES ('$name',  '$email',  
				'$comment', '$sana');";

			$result = queryMysql($sorov);

		  	echo "<h2> Fikr bildirganingiz uchun rahmat</h2>";
		  	return ;
		  }

		  
	} 

	
	?>
<article>

<p class="admin" color=#000000>ADMINGA HABAR JO`NATING! <br> </p>
<h3>Sayt faoliyatiga aloqador takliflaringiz, 
savollaringiz, yoki shikoyatlaringizni quyidagi 
bog`lanish formasi orqali bizga yuborishingiz mumkin.</h3>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
	
	<table>
		<tr>
			<td>Ism:</td>
			<td><input type="text" name="name" value="<?php echo $name ?>" size=50> 
				<span class="qizil">* <?php echo $nameErr;?> </span></td>
		</tr>
		<tr>
			<td>E-mail:</td>
			<td><input type="text" name="email" value="<?php echo $email; ?>" size=50> 
				<span class="qizil">* <?php echo $emailErr;?></span></td>
		</tr>
		<tr>
			<td>Xabar</td>
			<td><textarea name="comment" rows="10" cols="80"><?php echo $comment; ?></textarea>
		<span class="qizil">* <?php echo $commentErr;?> </span>
			</td>
		</tr>
		
	</table>
	<input type="reset"  value="Tozalash" style="width:120px">
	<input type="submit" value="Yuboring" style="width:120px">
</form>	
	<hr>

<?php 
	  $sorov = 'select * from fikr where status = 1 
	  			order by id_fikr desc';
	  $result = queryMysql($sorov);
	  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<article>";			
			echo "<p>".$row['name'].' '.$row['sana'].'</p>';
			echo "<p>".$row['xabar']."</p></article>";			
		}
?>

</article>
