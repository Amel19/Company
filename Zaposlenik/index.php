<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 1 ? : header("Location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaposlenik panel</title>
    <link rel="stylesheet" href="../Source/Css/panel.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
  <header>
    <h1>Zaposlenik panel</h1>
  </header>
  <main>
    <p>Pregled dokumenata</p>
    <ul>
      <li>
        <a href="narudzbe.php">Pregled narudzbi</a>
      </li>
      <li>
        <a href="primke.php">Pregled primki</a>
      </li>
      <li>
        <a href="racuni.php">Pregled računa</a>
      </li>
    </ul>
    <p>Unos dokumenata</p>
    <ul>
      <li>
        <a href="racun.php">Unos racuna</a>
      </li>
      <li>
        <a href="primka.php">Unos primke</a>
      </li>
    </ul>
  </main>
  <?php require "../footer.php"; ?>
</body>
</html>