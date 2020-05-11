<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Panel</title>
    <link rel="stylesheet" href="../Source/Css/panel.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
  <header>
    <h1>Administrator panel</h1>
  </header>
  <main>
    <p>Pregled unos i izmjena podataka</p>
    <ul>
      <li>
        <a href="artikli.php">Artikli</a>
      </li>
      <li>
        <a href="zaposlenici.php">Zaposlenici</a>
      </li>
      <li>
        <a href="poslovniPartneri.php">Poslovni partneri</a>
      </li>
      <li>
        <a href="radnoMjesto.php">Radna mjesta</a>
      </li>
      <li>
        <a href="kategorije.php">Kategorije</a>
      </li>
      <li>
        <a href="tipPlacanja.php">Tipovi plaćanja</a>
      </li>
    </ul>
    <p>Pregled dokumenata</p>
    <ul>
      <li>
        <a href="racuni.php">Pregled računa</a>
      </li>
      <li>  
        <a href="narudzbe.php">Pregled narudzbi</a>
      </li>
      <li>
        <a href="primke.php">Pregled primki</a>
      </li>
    </ul>
    <p>Unos dokumenata</p>
    <ul>
      <li>
        <a href="dodajZaposlenika.php">Dodaj zaposlenika</a>
      </li>
      <li>
        <a href="naruci.php">Narudzbe</a>
      </li>
      <li>
        <a href="dodajArtikal.php">Dodaj artikal</a>
      </li>
      <li>
        <a href="dodajPartnera.php">Dodaj partnera</a>
      </li>
      <li>
        <a href="dodajMjesto.php">Dodaj novo radno mjesto</a>
      </li>
      <li>
        <a href="dodajKategoriju.php">Dodaj novu kategoriju</a>
      </li>
      <li>
        <a href="dodajTipPlacanja.php">Dodaj novi tip placanja</a>
      </li>
    </ul>
  </main>
  <?php require "../footer.php"; ?>
</body>
</html>