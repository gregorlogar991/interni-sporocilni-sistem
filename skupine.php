<html>
	<head>
		<title>Dodajanje skupin</title>
	</head>
	<body>
		<form action="" method="POST">
			Nova skupina: <input name="imeskupine"> <button name="dodajskupino">Dodaj</button><br>
			<select name="id_stika">
				<?php
					session_start();
					$id_prijavljen = $_SESSION['id'];
	            	$con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
	            	$sqlstik = "select u.ime, u.priimek, u.id_uporabnika from uporabnik u";
	            	$rezstik = mysqli_query($con, $sqlstik);
	            	echo '<option>Izberi stik</option>';
	            	while($stik = mysqli_fetch_row($rezstik)){
		            	if($stik[2] != $id_prijavljen){
		            		echo '<option value="' . $stik[2] . '">' . $stik[0] . ' ' . $stik[1] . '</option>'; 
		            	}
		            }
				?>	
			</select>
			<select name="id_skupine">
				<?php
	            	$sqlskupina = "select s.id_skupine, s.naslov from skupina s where s.id_lastnika='$id_prijavljen'";
	            	$rezskupina = mysqli_query($con, $sqlskupina);
	            	echo '<option>Izberi skupino</option>';
	            	while($skupina = mysqli_fetch_row($rezskupina)){
	            		echo '<option value="' . $skupina[0] . '">' . $skupina[1] . '</option>'; 
	            	}
				?>	
			</select> <button name="dodajstik">Dodaj stik</button><br>
		</form>	
	</body>
</html>

<?php
	if(isset($_POST['dodajskupino'])){
		$novaskupina = mysqli_real_escape_string($con, $_POST['imeskupine']);
		if($novaskupina != ""){
			$sqldodaj = "INSERT INTO skupina(naslov, id_lastnika) VALUES ('$novaskupina', $id_prijavljen);";
			mysqli_query($con, $sqldodaj);
		}
		else{
			echo 'Vpisi ime!';
		}
	}
	if(isset($_POST['dodajstik'])){
		$id_stika = mysqli_real_escape_string($con, $_POST['id_stika']);
		$id_skupine = mysqli_real_escape_string($con, $_POST['id_skupine']);
		$sqlstik = "INSERT INTO skupinauporabnik(id_lastnika, id_skupine, id_dodanega) VALUES ('$id_prijavljen', '$id_skupine', '$id_stika')";
		mysqli_query($con, $sqlstik);
	}
	echo 'Izpis skupin in stikov: <br>';
	$sqlstiki = "select u.id_uporabnika from uporabnik u inner join skupinauporabnik s on u.id_uporabnika=s.id_dodanega where s.id_skupine=4";
	$rezstiki = mysqli_query($con, $sqlstiki);
	while($row = mysqli_fetch_row($rezstiki)){
		echo $row[0] . '<br>';
	}
?>