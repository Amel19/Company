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
    <title>Dodaj artikl</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Sniglet&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mukta&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Novi artikl</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>

    <main>
        <form action="zavrsi_artikal.php" method="post">
            <label for="naziv">Naziv</label>
                <input type="text" name="naziv" max_length="100">
            <label for="opis">Opis</label>
                <input type="text" name="opis" max_length="500">
            <label for="kategorija">Kategorija</label>
                <select name="kategorija" required>
                    <?php
                        require "../Classes/DatabaseClass.php";
                        $kategorije = new Database;
                        $kategorije->kategorije();
                    ?>
                </select>
            <label for="cijena">Cijena</label>
                <input type="number" name="cijena" placeholder="0.00" step="0.01" min="0.01" max="99.99" required>
            <label for="jedinicnaMjera">Jedinicna mjera</label>
                <input type="text" name="jedinicnaMjera" required>
            <label for="zaliha">Zaliha</label>
                <input type="number" name="zaliha" required>
            <button type="submit">Dodaj</button>
        </form>
    </main>

    <?php require "../footer.php"; ?>
</body>
</html>