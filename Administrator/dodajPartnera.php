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
    <title>Dodaj partnera</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Novi poslovni partner</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>

    <main>
        <form action="zavrsiDodavanjePartner.php" method="post">
            <label for="naziv">Naziv</label>
                <input type="text" name="naziv" max_length="100" required>
            <label for="adresa">Adresa</label>
                <input type="text" name="adresa" max_length="100" required>
            <label for="telefon">Telefon</label>
                <input type="text" name="telefon" max_length="50" required>
            <label for="telefax">Telefax</label>
                <input type="text" name="telefax" max_length="50" required>
            <label for="email">E-mail</label>
                <input type="email" name="email" max_length="50" required>
            <label for="partnerOd">Partner od</label>
                <input type="date" name="partnerOd" required>
            <button type="submit">Dodaj</button>
        </form>
    </main>

    <?php require "../footer.php"; ?>
</body>
</html>