<?php
	include "povezava.php";
<<<<<<< HEAD
	$id = $_GET['id'];
	$sql = "DELETE FROM transakcija WHERE id_transakcije='$id'";
	echo $sql;
	mysqli_query($con, $sql);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
=======
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

>>>>>>> 45dd96a7907ef6e48d8265eb403375bc9f6d7195
?>