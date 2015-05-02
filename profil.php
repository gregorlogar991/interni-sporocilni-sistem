<<<<<<< HEAD
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

    <title>Narrow Jumbotron Template for Bootstrap</title>

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
            <li role="presentation"><a href="poslano.php">Poslana sporočila</a></li>
            <li role="presentation"><a href="skupine.php">Ustvari skupino</a></li>            
            <li role="presentation"><a href="odjava.php">Odjava</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Prejeta sporočila</h3>
		<h4 class="text-muted"><?php session_start(); echo $_SESSION['ime'].' '. $_SESSION['priimek']; ?></h4>
      </div>

      <div class="jumbotron">

        <?php
        include "povezava.php";
        $osnutek = "";
        $id = $_SESSION['id']; //da vids ker uporabnik je prjavljen
        $sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.reciever ='$id'";
        $sqlvsebina = "select t.zadeva, t.vsebina, t.id_transakcije, t.cas, t.prebrano from transakcija t where t.reciever='$id'";
        $recieverrez = mysqli_query($con, $sqlreciever);
        $vsebinarez = mysqli_query($con, $sqlvsebina);
        while($reciever = mysqli_fetch_row($recieverrez)){
          $vsebina = mysqli_fetch_row($vsebinarez);
          $words = split(" ", $vsebina[1]);
          for ($i = 0; ($i < 5 && $i < count($words)); $i++) {
          $osnutek .= $words[$i] . " ";
          }
          if($vsebina[4]==0)
          {
            echo 'NEPREBRANO<a href="sporocilo1.php?id=' . $vsebina[2] .'" class="list-group-item">' . $reciever[0] . ' ' . $reciever[1] . ' <strong>' . $vsebina[0] . '</strong> - ' . $osnutek . ' ' .  $vsebina[3] . '</a>';
            $osnutek = "";
          }
          else
          {
            echo 'PREBRANO<a href="sporocilo1.php?id=' . $vsebina[2] .'" class="list-group-item">' . $reciever[0] . ' ' . $reciever[1] . ' <strong>' . $vsebina[0] . '</strong> - ' . $osnutek . ' ' .  $vsebina[3] . '</a>';
            $osnutek = "";          
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
=======
<html>
<head>
	<meta charset="UTF-8">
<<<<<<< HEAD
	<title>Prejeta</title>
=======
	<title>Porejeta</title>
>>>>>>> origin/master
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="list-group">
<<<<<<< HEAD
<?php
$osnutek = "";
session_start();
$id = $_SESSION['id']; //da vids ker uporabnik je prjavljen
$con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.reciever ='$id'";
$sqlvsebina = "select t.zadeva, t.vsebina, t.id_transakcije, t.cas, t.prebrano from transakcija t where t.reciever='$id'";
$recieverrez = mysqli_query($con, $sqlreciever);
$vsebinarez = mysqli_query($con, $sqlvsebina);
while($reciever = mysqli_fetch_row($recieverrez)){
	$vsebina = mysqli_fetch_row($vsebinarez);
	$words = split(" ", $vsebina[1]);
	for ($i = 0; ($i < 5 && $i < count($words)); $i++) {
	$osnutek .= $words[$i] . " ";
	}
	if($vsebina[4]==0)
	{
		echo 'NEPREBRANO<a href="sporocilo1.php?id=' . $vsebina[2] .'" class="list-group-item">' . $reciever[0] . ' ' . $reciever[1] . ' <strong>' . $vsebina[0] . '</strong> - ' . $osnutek . ' ' .  $vsebina[3] . '</a>';
		$osnutek = "";
	}
	else
	{
		echo 'PREBRANO<a href="sporocilo1.php?id=' . $vsebina[2] .'" class="list-group-item">' . $reciever[0] . ' ' . $reciever[1] . ' <strong>' . $vsebina[0] . '</strong> - ' . $osnutek . ' ' .  $vsebina[3] . '</a>';
		$osnutek = "";					
	}
}
?>
=======
		<?php
			$osnutek = "";
			session_start();
			$id = $_SESSION['id']; //da vids ker uporabnik je prjavljen
            $con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));
			$sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.reciever ='$id'";
			$sqlvsebina = "select s.zadeva, s.vsebina, t.id_transakcije, t.cas, t.prebrano from sporocilo s inner join transakcija t on t.id_sporocila = s.id_sporocila where t.reciever='$id'";
			$recieverrez = mysqli_query($con, $sqlreciever);
			$vsebinarez = mysqli_query($con, $sqlvsebina);
			while($reciever = mysqli_fetch_row($recieverrez)){
				$vsebina = mysqli_fetch_row($vsebinarez);
				$words = split(" ", $vsebina[1]);
				for ($i = 0; ($i < 5 && $i < count($words)); $i++) {
				  $osnutek .= $words[$i] . " ";
				}
				if($vsebina[4]==0)
				{
					echo 'NEPREBRANO<a href="sporocilo1.php?id=' . $vsebina[2] .'" class="list-group-item">' . $reciever[0] . ' ' . $reciever[1] . ' <strong>' . $vsebina[0] . '</strong> - ' . $osnutek . ' ' .  $vsebina[3] . '</a>';
					$osnutek = "";
				}
				else
				{
					echo 'PREBRANO<a href="sporocilo1.php?id=' . $vsebina[2] .'" class="list-group-item">' . $reciever[0] . ' ' . $reciever[1] . ' <strong>' . $vsebina[0] . '</strong> - ' . $osnutek . ' ' .  $vsebina[3] . '</a>';
					$osnutek = "";					
				}
			}


		?>
>>>>>>> origin/master
		  
		  
		</div>	
	</div>
</body>
</html>
>>>>>>> origin/master
