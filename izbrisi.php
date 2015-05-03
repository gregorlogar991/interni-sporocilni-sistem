<?php
	include "povezava.php";
	$id = $_GET['id'];
	$sql = "DELETE FROM transakcija WHERE id_transakcije='$id'";
	echo $sql;
	mysqli_query($con, $sql);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>