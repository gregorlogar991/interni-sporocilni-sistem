<html>
	<head>
		<title>Sporocilo</title>
	</head>
	<body>
		<?php
			$id = $_GET['id'];
            $con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
            $sqlsender = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender";
			$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.reciever;";
			$sqlvsebina = "select s.zadeva, s.vsebina, t.cas from sporocilo s inner join transakcija t on t.id_sporocila = s.id_sporocila where t.id_transakcije='$id'";
			$senderrez = mysqli_query($con, $sqlsender);
			$recieverrez = mysqli_query($con, $sqlreciever);
			$vsebinarez = mysqli_query($con, $sqlvsebina);
			while($vsebina = mysqli_fetch_row($vsebinarez)){
				$sender = mysqli_fetch_row($senderrez);
				$reciever = mysqli_fetch_row($recieverrez);
				echo 'Posiljatelj: ' . $sender[0] . ' ' . $sender[1] . '<br>';
				echo 'Prejemnik: ' . $reciever[0] . ' ' . $reciever[1] . '<br>';
				echo 'Zadeva: <strong>' . $vsebina[0] . '</strong><br>';
				echo $vsebina[1];
			}
		?>

	</body>
</html>