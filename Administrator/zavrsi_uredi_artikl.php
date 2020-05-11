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
        if(is_null($provjeriId->provjeriPostojanjeID($id, 'firma_artikl', 'artikl_id'))){
          header("Location:index.php");
          exit();
        }
        $nazivInput = $_POST['naziv'];
        $opisInput = $_POST['opis'];
        $kategorija = $_POST['kategorija'];
        $cijenaInput  = $_POST['cijena'];
        $jedinicnaMjeraInput = $_POST['jedinicnaMjera'];
        $zalihaInput = $_POST['zaliha'];
        require "../Classes/SafetyClass.php";
        $ocisti = new Safety;
        $naziv = $ocisti->provjeriUnos($nazivInput);
        $opis = $ocisti->provjeriUnos($opisInput);
        $cijena = $ocisti->provjeriUnos($cijenaInput);
        $jedinicnaMjera = $ocisti->provjeriUnos($jedinicnaMjeraInput);
        $zaliha = $ocisti->provjeriUnos($zalihaInput);
        $urediArtikl = new Database;
        $urediArtikl->urediArtikl($id, $naziv, $opis, $kategorija, $cijena, $jedinicnaMjera, $zaliha);
    }else{
        header("Location: artikli.php");
    }