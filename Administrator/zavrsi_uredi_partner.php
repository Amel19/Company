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
        if(is_null($provjeriId->provjeriPostojanjeID($id, 'firma_poslovni_partner', 'partner_id'))){
          header("Location:index.php");
          exit();
        }
        $nazivInput = $_POST['naziv'];
        $adresaInput = $_POST['adresa'];
        $telefonInput = $_POST['telefon'];
        $telefaxInput = $_POST['telefax'];
        $emailInput = $_POST['email'];
        $partnerOd = $_POST['partnerOd'];
        require "../Classes/SafetyClass.php";
        $ocisti = new Safety;
        $naziv = $ocisti->provjeriUnos($nazivInput);
        $adresa = $ocisti->provjeriUnos($adresaInput);
        $telefon = $ocisti->provjeriUnos($telefonInput);
        $telefax = $ocisti->provjeriUnos($telefaxInput);
        $email = $ocisti->provjeriUnos($emailInput);
        $urediPartnera = new Database;
        $urediPartnera->urediPoslovnogPartnera($id, $naziv, $adresa, $telefon, $telefax, $email, $partnerOd);
    }else{
        header("Location: poslovniPartneri.php");
    }