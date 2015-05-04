<?php

	$id_uporabnika = 0;
	$tip = $_GET['tip'];
	$id_uporabnika = $_GET['id_uporabnika'];
	$id_skupine = $_GET['id_skupine'];

	include 'povezava.php';
	if($tip == 1){
		$sqlupo = "DELETE FROM skupinauporabnik WHERE id_dodanega='$id_uporabnika' AND id_skupine='$id_skupine'";
		mysqli_query($con, $sqlupo);
	}
	else if($tip == 2){
		$sqlupoti = "DELETE FROM skupinauporabnik WHERE id_skupine='$id_skupine'";
		$sqlsku = "DELETE FROM skupina WHERE id_skupine='$id_skupine'";
		mysqli_query($con, $sqlupoti);
		mysqli_query($con, $sqlsku);
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
?>