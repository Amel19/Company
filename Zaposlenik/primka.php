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
    <title>Unesi primku</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Unos primke robe</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>
    <main>
    <form action="zavrsi_primka.php" method="post">
        <label for="narudzba">Odaberi narudzbu</label>
            <select name="narudzba" required>
                <?php
                    require "../Classes/DatabaseClass.php";
                    $narudzbe = new Database;
                    $narudzbe->ispisiNarudzbe();
                ?>
            </select>
        <label for="kolicina">Kolicina</label>
            <input type="number" min="1" name="kolicina" required>
        <button type="submit">Potvrdi primku</button>
    </form>
    </main>
    <?php require "../footer.php"; ?>
</body>
</html>