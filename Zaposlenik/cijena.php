<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 1 ? : header("Location:../index.php");

    $id = $_GET['id'];
    require "../Classes/DatabaseClass.php";
    $cijena = new Database;
    echo $cijena->dobaviCijenu($id);
?>