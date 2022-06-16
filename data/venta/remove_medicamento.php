<?php 

	session_start();
	$index=$_POST['id'];
	unset($_SESSION['ventas'][$index]);
	$datos=array_values($_SESSION['ventas']);
	unset($_SESSION['ventas']);
	$_SESSION['ventas']=$datos;

 ?>