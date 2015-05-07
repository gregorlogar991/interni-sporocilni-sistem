<html>
<head>
	<meta charset="UTF-8">
	<title>Novo sporocilo</title>
</head>
<body>
	<form action="" method="POST">
		<input type="radio" value="stik" name="naslovnik">
		Prejemnik:
		<select name="prejemnik">
			<?php
<<<<<<< HEAD
				include "povezava.php";
				session_start();
				$id=$_SESSION['id'];
=======
				session_start();
				$id=$_SESSION['id'];
           	 	$con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
>>>>>>> origin/master
            	$sql = "select u.ime, u.priimek, u.id_uporabnika from uporabnik u";
            	$rez = mysqli_query($con, $sql);
            	echo '<option>Izberi prejemnika</option>';
            	while($row = mysqli_fetch_row($rez)){
            		echo '<option value="' . $row[2] . '">'.$row[0] . ' ' . $row[1] . '</option>';
            	}
			?>	
		</select>
		</input><br>
		<input type="radio" value="skupina" name="naslovnik">
		Skupina:
		<select name="skupine">
			<?php
<<<<<<< HEAD
=======
           	 	$con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
>>>>>>> origin/master
            	$sqlskupina = "select s.id_skupine, s.naslov from skupina s where s.id_lastnika='$id'";
            	$rezskupina = mysqli_query($con, $sqlskupina);
            	echo '<option>Izberi skupino</option>';
            	while($skupina = mysqli_fetch_row($rezskupina)){
            		echo '<option value="' . $skupina[0] . '">' . $skupina[1] . '</option>'; 
            	}
			?>	
		</select></input><br>
		Zadeva: <input name="zadeva"><br>
		Vsebina: <textarea name="vsebina"></textarea>
		<input type="submit" name="poslji" value="Pošlji" >

	</form>

<?php
	$sendr=$id;
	if(isset($_POST['poslji'])){
		$vseb=$_POST['vsebina'];
		$zad=$_POST['zadeva'];
		if(isset($_POST['naslovnik'])){
			if($_POST['naslovnik'] == 'stik'){
				$resivr= $_POST['prejemnik'];
				$sqlstik="insert into transakcija(cas,sender,reciever,prebrano,vsebina,zadeva)
					 values(now(),'$sendr','$resivr',0,'$vseb','$zad')";
				mysqli_query($con,$sqlstik);
			}
			else if($_POST['naslovnik'] == 'skupina'){
				$id_skupine = $_POST['skupine'];
				$sqlstiki = "select u.id_uporabnika from uporabnik u inner join skupinauporabnik s on u.id_uporabnika=s.id_dodanega where s.id_skupine='$id_skupine'";
				$rezstiki = mysqli_query($con, $sqlstiki);
				while($row = mysqli_fetch_row($rezstiki)){
					$sqlskupina="insert into transakcija(cas,sender,reciever,prebrano,vsebina,zadeva)
					values(now(),'$sendr','$row[0]',0,'$vseb','$zad')";
					mysqli_query($con,$sqlskupina);
				}
			}
		}
		else{
			echo 'Izberi prejemnika/prejemnike';
		}
	}

?>
</body>
</html>
<?php

//vpis v bazo

?>