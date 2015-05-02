<html>
<head>
<<<<<<< HEAD
	<meta charset="UTF-8">
=======
>>>>>>> origin/master
	<title>Novo sporocilo</title>
</head>
<body>
	<form action="" method="POST">
		Prejemnik:
<<<<<<< HEAD
		<select name="prejemnik">
=======
		<select>
>>>>>>> origin/master
			<?php
            	$con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
            	$sql = "select u.ime, u.priimek, u.id_uporabnika from uporabnik u";
            	$rez = mysqli_query($con, $sql);
            	echo '<option>Izberi prejemnika</option>';
            	while($row = mysqli_fetch_row($rez)){
<<<<<<< HEAD
            		echo '<option value="' . $row[2] . '">'.$row[0] . ' ' . $row[1] . '</option>';
=======
            		echo '<option value="' . $row[2] . '">' . $row[0] . ' ' . $row[1] . '</option>'; 
>>>>>>> origin/master
            	}
			?>	
		</select><br>
		Zadeva: <input name="zadeva"><br>
		Vsebina: <textarea name="vsebina"></textarea>
<<<<<<< HEAD
		<input type="submit" name="poslji" value="Pošlji" >

	</form>

<?php
session_start();
$id=$_SESSION['id'];
if(isset($_POST['poslji']))
{
	$sendr=$id;
	$resivr= $_POST['prejemnik'];
	$vseb=$_POST['vsebina'];
	$zad=$_POST['zadeva'];

	$sql="insert into transakcija(cas,sender,reciever,prebrano,vsebina,zadeva)
		 values(now(),'$sendr','$resivr',0,'$vseb','$zad')";
	mysqli_query($con,$sql);
}

?>
=======
	</form>
>>>>>>> origin/master
</body>
</html>
<?php

//vpis v bazo

?>