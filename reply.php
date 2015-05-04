<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<title>Odgovor</title>
</head>
<body>
<?php
//TLE SAM DOLZINO FORME SPREMEN U CSS NA 50% RECIMO DA NE BO PREVEC K JE GRDO
include "povezava.php";
session_start();
if(isset($_SESSION['id']))
{
	$ime=$_SESSION['odgovor']['odgovorime'];
	$priimek=$_SESSION['odgovor']['odgovorpriimek'];
	if(isset($_POST['poslji']))
	{
		$vsebina=$_POST['vsebina'];
		$zadeva=$_POST['zadeva'];
		$id=$_SESSION['odgovor']['odgovorid'];
		$idd=$_SESSION['id'];
		$sql="insert into transakcija(cas,sender,reciever,prebrano,vsebina,zadeva)
			values(now(),'$idd','$id',0,'$vsebina','$zadeva')";
		mysqli_query($con,$sql);
		header("location:profil.php");
}
}
else
{
	header("location:index.php");
}

?>
<form method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Odgovor na sporočilo osebe: <?php echo $ime .' '. $priimek; ?> </label>
    <input type="text" name="zadeva" class="form-control" placeholder="Zadeva">
    <textarea class="form-control" name="vsebina" rows="5" placeholder="Vsebina"></textarea>
    <input type="submit" name="poslji" value="Pošlji" >
  </div>
</form>
</body>
</html>