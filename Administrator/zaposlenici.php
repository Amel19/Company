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
    <title>Zaposlenici</title>
    <link rel="stylesheet" href="../Source/Css/table.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
</head>
<body>
  <header>
    <h1>Svi zaposlenici</h1>
    <div id="home">
      <a href="index.php">Početna</a>
    </div>
  </header>
  <main>
    <div id="tableWrapper">
    <?php
    require "../Classes/DatabaseClass.php";
    $zaposlenici = new Database;
    $zaposlenici->prikaziZaposlenike();
    ?>
    </div> 
  </main>
  <?php require "../footer.php"; ?>
</body>
</html>