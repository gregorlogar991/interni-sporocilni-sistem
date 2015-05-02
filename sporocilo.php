<html>
	<head>
		<title>Sporocilo</title>
	</head>
	<body>
	<h3>Poslana sporocila</h3>
	<?php
			include "povezava.php";
			$id = $_GET['id'];
<<<<<<< HEAD
=======
            $con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
>>>>>>> origin/master
            $sqlsender = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.id_transakcije='$id'";
			$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.reciever where t.id_transakcije='$id';";
			$sqlvsebina = "select t.zadeva, t.vsebina, t.cas from transakcija t where t.id_transakcije='$id'";
			$senderrez = mysqli_query($con, $sqlsender);
			$recieverrez = mysqli_query($con, $sqlreciever);
			$vsebinarez = mysqli_query($con, $sqlvsebina);
			while($vsebina = mysqli_fetch_row($vsebinarez)){
				$sender = mysqli_fetch_row($senderrez);
				$reciever = mysqli_fetch_row($recieverrez);
				echo 'Posiljatelj: ' . $sender[0] . ' ' . $sender[1] . '<br>';
				echo 'Prejemnik: ' . $reciever[0] . ' ' . $reciever[1] . '<br>';
				echo 'Cas: ' . $vsebina[2] . '<br>';
				echo 'Zadeva: <strong>' . $vsebina[0] . '</strong><br>';
				echo $vsebina[1];
			}
		?>
		<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
	</body>
</html>
