<?php

	include 'povezava.php';
	$id = $_GET['id'];
	$sql = "update transakcija set id_predala=0 where id_transakcije='$id'";
	mysqli_query($con, $sql);
	header('Location: profil.php?predal=0');
?>