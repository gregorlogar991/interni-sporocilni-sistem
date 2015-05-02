<html>
<head>
	<meta charset="UTF-8">
	<title>Prejeta</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="list-group">
<?php
$osnutek = "";
session_start();
$id = $_SESSION['id']; //da vids ker uporabnik je prjavljen
$con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.reciever ='$id'";
$sqlvsebina = "select t.zadeva, t.vsebina, t.id_transakcije, t.cas, t.prebrano from transakcija t where t.reciever='$id'";
$recieverrez = mysqli_query($con, $sqlreciever);
$vsebinarez = mysqli_query($con, $sqlvsebina);
while($reciever = mysqli_fetch_row($recieverrez)){
	$vsebina = mysqli_fetch_row($vsebinarez);
	$words = split(" ", $vsebina[1]);
	for ($i = 0; ($i < 5 && $i < count($words)); $i++) {
	$osnutek .= $words[$i] . " ";
	}
	if($vsebina[4]==0)
	{
		echo 'NEPREBRANO<a href="sporocilo1.php?id=' . $vsebina[2] .'" class="list-group-item">' . $reciever[0] . ' ' . $reciever[1] . ' <strong>' . $vsebina[0] . '</strong> - ' . $osnutek . ' ' .  $vsebina[3] . '</a>';
		$osnutek = "";
	}
	else
	{
		echo 'PREBRANO<a href="sporocilo1.php?id=' . $vsebina[2] .'" class="list-group-item">' . $reciever[0] . ' ' . $reciever[1] . ' <strong>' . $vsebina[0] . '</strong> - ' . $osnutek . ' ' .  $vsebina[3] . '</a>';
		$osnutek = "";					
	}
}
?>
		  
		  
		</div>	
	</div>
</body>
</html>