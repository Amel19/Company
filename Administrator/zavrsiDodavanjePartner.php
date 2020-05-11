<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");

    $nazivUnos = $_POST['naziv'];
    $adresaUnos = $_POST['adresa'];
    $telefonUnos = $_POST['telefon'];
    $telefaxUnos = $_POST['telefax'];
    $emailUnos = $_POST['email'];
    $partnerOd = $_POST['partnerOd'];
    require "../Classes/SafetyClass.php";
    $ocisti = new Safety;
    $naziv = $ocisti->provjeriUnos($nazivUnos);
    $adresa = $ocisti->provjeriUnos($adresaUnos);
    $telefon = $ocisti->provjeriUnos($telefonUnos);
    $telefax = $ocisti->provjeriUnos($telefaxUnos);
    $email = $ocisti->provjeriUnos($emailUnos);
    require "../Classes/DatabaseClass.php";
    $unesiZaposlenika = new Database;
    $unesiZaposlenika->unesiPoslovnogPartnera($naziv, $adresa, $telefon, $telefax, $email, $partnerOd);
?>