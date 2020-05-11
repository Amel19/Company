<?php
session_start();
$korisnik_id = $_SESSION['zaposlenik_id'];
$kredencijali = $_SESSION['zaposlenik_credentials'];
isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
$kredencijali == 1 ? : header("Location:../index.php");
    $zaposlenikId = $korisnik_id;
    $placanje = $_POST['placanje'];
    $komentar = $_POST['komentar'];
    $total = $_POST['total'];
    $uplaceno = $_POST['uplaceno'];
    $brojArtikala = $_POST['brojArtikala'];

    require "../Classes/DatabaseClass.php";
    $ubaciRacun = new Database;
    $ubaciRacun->ubaciRacun($zaposlenikId, $placanje, $komentar, $total, $uplaceno);
    $dodajStavke = new Database;
    $racunID = new Database;
    $oduzmiKolicinu = new Database;
    $racun = $racunID->dobaviIdRacuna();
    for($i = 1; $i <= $brojArtikala; $i++){
        $artiklId = $_POST['artikl' . $i];
        $kolicina = $_POST['kolicina' . $i];
        
        $dodajStavke->dodajStavke($racun, $artiklId, $kolicina);
        $oduzmiKolicinu->oduzmiKolicinu($artiklId, $kolicina);
    }
?>