<?php include "../db.php";
ob_start();
 ?>
<?php session_start(); ?>


<?php

	$_SESSION['dept']=null;
	header("Location:../index.php");

?>
