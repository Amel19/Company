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
    <title>Nova narudžba</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Nova narudžba</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>
    <main>
    <form action="zavrsi_naruci.php" method="post">
        <label for="partner">Poslovni partner</label>
            <select name="partner" required>
                <?php
                    require "../Classes/DatabaseClass.php";
                    $partneri = new Database;
                    $partneri->ispisiPartnere();
                ?>
            </select>
        <label for="naziv">Naziv artikla</label>
            <input type="text" name="naziv" max_length="100" required>
        <label for="jedinicnaMjera">Jedinicna mjera</label>
            <input type="text" name="jedinicnaMjera" max_length="100" required>
        <label for="kolicina">Kolicina</label>
            <input type="number" name="kolicina" min='1' required>
        <button type="submit">Naruci</button>
    </form>
    </main>
    <?php require "../footer.php"; ?>
</body>
</html>