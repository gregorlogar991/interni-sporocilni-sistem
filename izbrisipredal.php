<?php

	include 'povezava.php';
	$id = $_GET['id'];
	$del = "DELETE FROM predal where id_predala='$id'";
	$upd = "UPDATE transakcija set id_predala=0 where id_predala='$id'";
	mysqli_query($con, $del);
	mysqli_query($con, $upd);

?>