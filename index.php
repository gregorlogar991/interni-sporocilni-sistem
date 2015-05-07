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
        <h2 class="form-signin-heading" align="center">Interni sistem</h2>
        <label for="inputEmail" class="sr-only">Uporabnisko ime</label>
        <input type="text" id="inputEmail" class="form-control" name="user" placeholder="Uporabnisko ime">
        <label for="inputPassword" class="sr-only">Geslo</label>
        <input type="password" id="inputPassword" name="geslo" class="form-control" placeholder="Geslo">
        <?php
          
          session_start();
          if(isset($_POST['submit'])){
            $con = mysqli_connect("localhost","root","","sporocilni_sistem") or die("Error " . mysqli_error($link));

            $user = mysqli_real_escape_string($con, $_POST['user']);
            $geslo = mysqli_real_escape_string($con, $_POST['geslo']);

            if($_POST['user'] == "" || $_POST['geslo'] == ""){
              echo '<font color="red">Izpolnite VSE podatke</font>';
            }
            else{
<<<<<<< HEAD
              $sql = "select ID_uporabnika, ime, priimek, zadnja_prijava from uporabnik where uporabnisko_ime ='$user' and geslo ='$geslo'";
=======
              $sql = "select ID_uporabnika, ime, priimek from uporabnik where uporabnisko_ime ='$user' and geslo ='$geslo'";
>>>>>>> origin/master
              $select = mysqli_query($con, $sql);
              if(mysqli_num_rows($select) == 1){
                $row = mysqli_fetch_row($select);
                $_SESSION['id'] = $row[0];
                $_SESSION['ime'] = $row[1];
<<<<<<< HEAD
                $_SESSION['priimek'] = $row[2];
                $_SESSION['prijava']=$row[3];                
=======
                $_SESSION['priimek'] = $row[2];                
>>>>>>> origin/master
                $id=$_SESSION['id'];
                //$sql= "update uporabnik set zadnja_prijava = now() where ID_uporabnika = '$id'";
                //mysqli_query($con,$sql);
                header('Location: profil.php');
              }
              else{
                echo '<font color="red" align="center">Napacni podatki!</font>';
              }
            }
          }
          if(isset($_POST['registracija']))
          {
            header('Location: registracija.php');
          }
        ?>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Vpis</button>
        <button class="btn btn-lg btn-success btn-block" name="registracija">Registracija</button>
      </form>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

