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
        if(is_null($provjeriId->provjeriPostojanjeID($id, 'firma_radno_mjesto', 'mjesto_id'))){
          header("Location:index.php");
          exit();
        }
        $nazivUnos = $_POST['naziv'];
        $opisUnos = $_POST['opis'];
        require "../Classes/SafetyClass.php";
        $ocisti = new Safety;
        $naziv = $ocisti->provjeriUnos($nazivUnos);
        $opis = $ocisti->provjeriUnos($opisUnos);
        $urediMjesto = new Database;
        $urediMjesto->urediRadnoMjesto($id, $naziv, $opis);
    }else{
        header("Location: radnoMjesto.php");
    }