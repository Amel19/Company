<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 1 ? : header("Location:../index.php");
    $narudzba = $_POST['narudzba'];
    $kolicina = $_POST['kolicina'];
    require "../Classes/DatabaseClass.php";
    $primka = new Database;
    $primka->potvrdiPrimku($narudzba);
    $primka->primkaNarudzbe($narudzba, $kolicina);
?>