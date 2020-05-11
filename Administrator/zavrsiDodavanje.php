<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");

    $imeUnos = $_POST['ime'];
    $prezimeUnos = $_POST['prezime'];
    $adresaUnos = $_POST['adresa'];
    $telefonUnos = $_POST['telefon'];
    $emailUnos = $_POST['email'];
    $godine = $_POST['godine'];
    $datumZaposlenja = $_POST['datumZaposlenja'];
    $korisnickoImeUnos = $_POST['korisnickoIme'];
    $sifra = $_POST['sifra'];
    $sifraHash = md5(md5($sifra));
    $radnoMjesto = $_POST['mjesto'];

    require "../Classes/SafetyClass.php";
    $ocisti = new Safety;
    $ime = $ocisti->provjeriUnos($imeUnos);
    $prezime = $ocisti->provjeriUnos($prezimeUnos);
    $adresa = $ocisti->provjeriUnos($adresaUnos);
    $telefon = $ocisti->provjeriUnos($telefonUnos);
    $email = $ocisti->provjeriUnos($emailUnos);
    $korisnickoIme = $ocisti->provjeriUnos($korisnickoImeUnos);

    require "../Classes/DatabaseClass.php";
    $unesiZaposlenika = new Database;
    $unesiZaposlenika->unesiZaposlenika($ime, $prezime, $adresa, $telefon, $email, $godine, $datumZaposlenja, $korisnickoIme, $sifraHash, $radnoMjesto);
?>