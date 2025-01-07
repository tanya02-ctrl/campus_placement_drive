<?php include "../db.php";
ob_start();
 ?>
<?php session_start(); ?>


<?php

	$_SESSION['rolln']=null;
	$_SESSION['name']=null;
	header("Location:../index.php");

?>
