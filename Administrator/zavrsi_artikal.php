<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");
  
    $nazivInput = $_POST['naziv'];
    $opisInput = $_POST['opis'];
    $kategorija = $_POST['kategorija'];
    $cijenaInput = $_POST['cijena'];
    $jedinicnaMjeraInput = $_POST['jedinicnaMjera'];
    $zalihaInput = $_POST['zaliha'];

    require "../Classes/SafetyClass.php";
    $ocisti = new Safety;
    $naziv = $ocisti->provjeriUnos($nazivInput);
    $opis = $ocisti->provjeriUnos($opisInput);
    $cijena = $ocisti->provjeriUnos($cijenaInput);
    $jedinicnaMjera = $ocisti->provjeriUnos($jedinicnaMjeraInput);
    $zaliha = $ocisti->provjeriUnos($zalihaInput);


    require "../Classes/DatabaseClass.php";
    $dodajArtikal = new Database;
    $dodajArtikal->dodajArtikal($naziv, $opis, $kategorija, $cijena, $jedinicnaMjera, $zaliha);
?>