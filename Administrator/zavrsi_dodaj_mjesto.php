<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");
  
    $nazivInput = $_POST['naziv'];
    $opisInput = $_POST['opis'];
    require "../Classes/SafetyClass.php";
    $ocisti = new Safety;
    $naziv = $ocisti->provjeriUnos($nazivInput);
    $opis = $ocisti->provjeriUnos($opisInput);
    require "../Classes/DatabaseClass.php";
    $dodajRadnoMjesto = new Database;
    $dodajRadnoMjesto->dodajRadnoMjesto($naziv, $opis);
?>