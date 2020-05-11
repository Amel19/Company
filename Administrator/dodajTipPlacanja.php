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
    <title>Dodaj tip placanja</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Novi tip plaćanja</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>

    <main>
        <form action="zavrsi_dodaj_tipPlacanja.php" method="post">
            <label for="naziv">Naziv</label>
                <input type="text" name="naziv" max_length="100" required>
            <button type="submit">Dodaj</button>
        </form>
    </main>

    <?php require "../footer.php"; ?>
</body>
</html>