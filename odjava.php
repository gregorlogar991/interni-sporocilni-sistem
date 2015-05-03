<?php
include "povezava.php";
session_start();
$id=$_SESSION['id'];
$sql= "update uporabnik set zadnja_prijava = now() where ID_uporabnika = '$id'";
mysqli_query($con,$sql);
session_destroy();
header("location:index.php");
?>