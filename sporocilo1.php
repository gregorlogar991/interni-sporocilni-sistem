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
            $sqlsender = "select u.ime, u.priimek, t.cas, u.id_uporabnika from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.id_transakcije='$id'";
=======
            $sqlsender = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.id_transakcije='$id'";
>>>>>>> origin/master
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
				echo 'Zadeva: <strong>' . $vsebina[0] . '</strong><br>';
				echo $vsebina[1];
<<<<<<< HEAD
				$odgovor=$sender[3];
				$odgovorime=$sender[0];
				$odgovorpriimek=$sender[1];
=======
>>>>>>> origin/master
			}
			$sqlquery="update transakcija set prebrano = 1 where ID_transakcije = '$id'";
			mysqli_query($con,$sqlquery);
		?>
<<<<<<< HEAD
	<form method="POST">
	<input type="submit" name="reply" value="Odgovori" >
	<?php
	if(isset($_POST['reply']))
		{
			session_start();
			$_SESSION['odgovor']['odgovorid']=$odgovor;
			$_SESSION['odgovor']['odgovorime']=$odgovorime;
			$_SESSION['odgovor']['odgovorpriimek']=$odgovorpriimek;
			header("location:reply.php");
		}
	?>
	</form>
=======
>>>>>>> origin/master

	</body>
</html>
