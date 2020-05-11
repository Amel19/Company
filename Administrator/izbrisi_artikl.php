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
        if(is_null($provjeriId->provjeriPostojanjeID($id, 'firma_artikl', 'artikl_id'))){
          header("Location:index.php");
          exit();
        }
        $izbrisiArtikl = new Database;
        $izbrisiArtikl->izbrisiArtikal($id);
    }else{
        header("Location:artikli.php");
    }
?>