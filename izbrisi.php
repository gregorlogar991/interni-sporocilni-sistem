<?php
	include "povezava.php";
	session_start();
	if(isset($_SESSION['id']))
	{
		$id = $_GET['id'];
		$sql = "DELETE FROM transakcija WHERE id_transakcije='$id'";
		echo $sql;
		mysqli_query($con, $sql);
		header('Location: ' . $_SERVER['HTTP_REFERER']);		
	}
	else
	{
		header("location:index.php");
	}

?>