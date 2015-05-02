<html>
<head>
	<title>Novo sporocilo</title>
</head>
<body>
	<form action="" method="POST">
		Prejemnik:
		<select>
			<?php
            	$con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
            	$sql = "select u.ime, u.priimek, u.id_uporabnika from uporabnik u";
            	$rez = mysqli_query($con, $sql);
            	echo '<option>Izberi prejemnika</option>';
            	while($row = mysqli_fetch_row($rez)){
            		echo '<option value="' . $row[2] . '">' . $row[0] . ' ' . $row[1] . '</option>'; 
            	}
			?>	
		</select><br>
		Zadeva: <input name="zadeva"><br>
		Vsebina: <textarea name="vsebina"></textarea>
	</form>
</body>
</html>
<?php

//vpis v bazo

?>