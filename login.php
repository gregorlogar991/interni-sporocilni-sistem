<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST" action="">
        <h2 class="form-signin-heading">Vpis</h2>
        <label for="inputEmail" class="sr-only">Uporabnisko ime</label>
        <input type="text" id="inputEmail" class="form-control" name="user" placeholder="Uporabnisko ime">
        <label for="inputPassword" class="sr-only">Geslo</label>
        <input type="password" id="inputPassword" name="geslo" class="form-control" placeholder="Geslo">
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>


<?php
  
  if(isset($_POST['submit'])){
    $con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));

    $user = $_POST['user'];
    $geslo = $_POST['geslo'];

    if($_POST['user'] == "" || $_POST['geslo'] == ""){
      echo 'izpolnite podatke';
    }
    $sql = "select ID_uporabnika from uporabnik where uporabnisko_ime ='$user' and geslo ='$geslo'";
    $select = mysqli_query($con, $sql);
    if(mysqli_num_rows($select) == 1){
      echo 'prijavljen';
    }
    else{
      echo 'niste prijavljeni';
    }
  }


 /* 
  $sql = "INSERT INTO uporabnik() values";

  $rez = mysqli_query($con, $sql);*/


?>
