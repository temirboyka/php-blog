<?php

// Xato hisobot:
error_reporting(E_ALL^E_NOTICE);

// Bazani ulanish fayli:
require 'connect.php';


$extension='';
$files_array = array();

/* Katalogini ochish va Loop barcha nomerini orqali bog`lash: */


$dir_handle = @opendir($directory) or die("Bizda files katalog ochilmagan!");

while ($file = readdir($dir_handle)) 
{
	/* Tizimli fayllarini o`tish: */
	if($file{0}=='.') continue;
	
	/* End ()  va explode() funktsiyasi tomonidan hosil qator so`nggi narsani qaytaradi: */
	
	$extension = strtolower(end(explode('.',$file)));
	
	/*  Php fayllar o`tish: */
	if($extension == 'php') continue;

	$files_array[]=$file;
}
/* Alifbo tartibida fayllarni tartiblash */

sort($files_array,SORT_STRING);

$file_downloads=array();

$result = mysql_query("SELECT * FROM manager");

//if (mysql_num_rows($result))

//while($row=mysql_fetch_assoc($result))
{
	/* $ File_downloads qator asosiy fayl nomi bo'ladi,va yuklamalar sonini o'z ichiga oladi: */

		
	$file_downloads[$row['filename']]=$row['downloads'];
}

?>



<div id="file-manager">

    <ul class="manager">
  
    <?php 

        foreach($files_array as $key=>$val)
        {
            echo '<li><a href="download.php?file='.urlencode($val).'">'.$val.' 
                    <span class="download-count" title="Yuklab olish">'.(int)$file_downloads[$val].'</span> <span class="download-label">Yuklash</span></a>
                    </li>';
        }
    
    ?>
  </ul>

</div>
<link rel="stylesheet" type="text/css" href="styles.css" />
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.2.6.css" media="screen" />

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>