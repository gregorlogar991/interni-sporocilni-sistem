<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

      <link rel="stylesheet" type="text/css" href="loginRegistracija.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <title>Interni sporocilni sistem</title>
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="signin.css" rel="stylesheet">
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST" action="">
        <h2 class="form-signin-heading" align="center">Registracija</h2>

        <label for="inputime" class="sr-only">Ime</label>
        <input type="text" id="inputime" class="form-control" name="ime" placeholder="Ime">
        <br>
        <label for="inputpriimek" class="sr-only">Priimek</label>
        <input type="text" id="inputtpriimek" class="form-control" name="priimek" placeholder="Priimek">
        <br>
        <label for="inputEmail" class="sr-only">Uporabnisko ime</label>
        <input type="text" id="inputEmail" class="form-control" name="user" placeholder="Uporabnisko ime">
        <br>
        <label for="inputPassword" class="sr-only">Geslo</label>
        <input type="password" id="inputPassword" name="geslo" class="form-control" placeholder="Geslo">
        
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Registriraj se</button>
         <button class="btn btn-lg btn-primary btn-block" name="back" type="back">Nazaj</button>
      </form>
    </div> <!-- /container -->

    <?php
    include 'povezava.php';
    if(isset($_POST['submit']))
    {
        $ime=mysqli_real_escape_string($con,$_POST['ime']);
        $priimek=mysqli_real_escape_string($con,$_POST['priimek']);
        $upoime=mysqli_real_escape_string($con, $_POST['user']);
        $geslo=md5($_POST['geslo']);

        if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
        } 

        $sql="INSERT INTO uporabnik(ime,priimek,uporabnisko_ime,geslo) values('$ime','$priimek','$upoime','$geslo')";

        if ($con->query($sql) === TRUE) {
            echo "Uspešno ste se registrirali!";
            header('Location: index.php');
        } else {
            echo "Napaka: <br>" . $con->error;
    }}
    else if(isset($_POST['back']))
    {
        header('Location: index.php');
    }
    
    ?>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

