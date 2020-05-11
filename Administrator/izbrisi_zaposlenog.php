<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
      require "../Classes/DatabaseClass.php";
      $provjeriId = new Database;
      if(is_null($provjeriId->provjeriPostojanjeID($id, 'zaposlenik', 'zaposlenik_id'))){
        header("Location:index.php");
        exit();
      }
    $izbrisiZaposlenog = new Database;
    $izbrisiZaposlenog->izbrisiZaposlenog($id);
    }else{
        header("Location:zaposlenici.php");
    }
?>