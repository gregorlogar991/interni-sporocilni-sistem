<html>
	<head>
		<title>Sporocilo</title>
	</head>
	<body>
	<h3>Poslana sporocila</h3>
	<?php
			$id = $_GET['id'];
            $con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
<<<<<<< HEAD
            $sqlsender = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.id_transakcije='$id'";
			$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.reciever where t.id_transakcije='$id';";
			$sqlvsebina = "select t.zadeva, t.vsebina, t.cas from transakcija t where t.id_transakcije='$id'";
=======
            $sqlsender = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender";
			$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.reciever;";
			$sqlvsebina = "select s.zadeva, s.vsebina, t.cas from sporocilo s inner join transakcija t on t.id_sporocila = s.id_sporocila where t.id_transakcije='$id'";
>>>>>>> origin/master
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
			$sqlquery="update transakcija set prebrano = 1 where ID_transakcije = '$id'";
			if (mysqli_query($con,$sqlquery)) {
			    echo "";
			} 
			else {
			    echo "Error updating record: " . $mysqli_error($con);
			   }
		?>

	</body>
</html>
