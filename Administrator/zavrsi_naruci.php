<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");
  
    $partner = $_POST['partner'];
    $nazivInput = $_POST['naziv'];
    $mjeraInput = $_POST['jedinicnaMjera'];
    $kolicinaInput = $_POST['kolicina'];
    require "../Classes/SafetyClass.php";
    $ocisti = new Safety;
    $naziv = $ocisti->provjeriUnos($nazivInput);
    $mjera = $ocisti->provjeriUnos($mjeraInput);
    $kolicina = $ocisti->provjeriUnos($kolicinaInput);

    require "../Classes/DatabaseClass.php";
    $naruci = new Database;
    $naruci->naruci($partner, $naziv, $mjera, $kolicina);
?>