<?php 

session_start();
include_once('inc/functions.php');

if (isset($_GET['chiqish'])) {
	destroySession();

	$s= 'Refresh:0; url='.SITE;
		header($s);
}

if (isset($_POST['name']) && isset($_POST['password'])) {
	$name=sanitizeString($_POST['name']);
	$password=sanitizeString($_POST['password']);

	if ($name=='admin' && $password=='admin') {
		$_SESSION['user']="admin";

		$s= 'Refresh:0; url='.SITE.'/inc/list.php';
		header($s);

	} else 
	{echo "Xato kiritdingiz!";}
}



 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Admin bo`limi</title>
</head>
<body>
<h3> Admin login va parolini kiriting! </h3>
<form action="admin.php" method="POST">
	
Login: <input type="text" name="name"> <br>
Parol: <input type="password" name="password"> <br>
       <input type="reset" value="Tozalash">	
        <input type="submit" value="Kirish">		
       	


</form>



</body>
</html>