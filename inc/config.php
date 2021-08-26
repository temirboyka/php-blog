<?php
	$dbhost  = 'localhost';    	// o'zgartirish shart emas
	$dbname  = 'husniddin';    		// Ma'lumotlar bazasi nomi
	$dbuser  = 'husniddin';   		// user nomi
	$dbpass  = '12345';   			// parol

	// server bilan aloqa o'rnatish
	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($connection->connect_error) {
	    die("MySQLga ulanishda xatolik sodir bo`ldi: ". 
	    	$connection->connect_error);
	}
	
	// o'zgarmasni e'lon qilish
	define('SITE', 'http://husniddin.uz');

 /***************************************
  * PHP va MySQLda tayyorlangan         *
  * (C) 2019-2020 Husniddin Temirov     *
  * http://husniddin.uz                 *
  * email:temir_boyka.bk@ru             *
  * email:temirov_husniddin@mail.ru     *
  ***************************************/
?>