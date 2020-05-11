<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        require "../Classes/DatabaseClass.php";
        $provjeriId = new Database;
        if(is_null($provjeriId->provjeriPostojanjeID($id, 'zaposlenik', 'zaposlenik_id'))){
          header("Location:index.php");
          exit();
        }
        $imeUnos = $_POST['ime'];
        $prezimeUnos = $_POST['prezime'];
        $adresaUnos = $_POST['adresa'];
        $telefonUnos = $_POST['telefon'];
        $emailUnos = $_POST['email'];
        $godine = $_POST['godine'];
        $datumZaposlenja = $_POST['datumZaposlenja'];
        $korisnickoImeUnos = $_POST['korisnickoIme'];
        $radnoMjesto = $_POST['mjesto'];
        require "../Classes/SafetyClass.php";
        $ocisti = new Safety;
        $ime = $ocisti->provjeriUnos($imeUnos);
        $prezime = $ocisti->provjeriUnos($prezimeUnos);
        $adresa = $ocisti->provjeriUnos($adresaUnos);
        $telefon = $ocisti->provjeriUnos($telefonUnos);
        $email = $ocisti->provjeriUnos($emailUnos);
        $korisnickoIme = $ocisti->provjeriUnos($korisnickoImeUnos);
        $urediArtikl = new Database;
        $urediArtikl->urediZaposlenika($id, $ime, $prezime, $adresa, $telefon, $email, $godine, $datumZaposlenja, $korisnickoIme, $radnoMjesto);
    }else{
        header("Location: zaposlenici.php");
    }