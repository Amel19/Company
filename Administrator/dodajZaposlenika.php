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
    <title>Dodaj zaposlenika</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Dodavanje novog zaposlenika</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>

    <main>
        <form action="zavrsiDodavanje.php" method="post">
            <label for="ime">Ime</label>
                <input type="text" name="ime" max_length="100" required>
            <label for="prezime">Prezime</label>
                <input type="text" name="prezime" max_length="100" required>
            <label for="adresa">Adresa</label>
                <input type="text" name="adresa" max_length="100" required>
            <label for="telefon">Telefon</label>
                <input type="text" name="telefon" max_length="100" required>
            <label for="email">E-mail</label>
                <input type="email" name="email" max_length="100" required>
            <label for="godine">Godine</label>
                <input type="number" name="godine" min="1" max="70" required>
            <label for="datumZaposlenja">Datum Zaposlenja</label>
                <input type="date" name="datumZaposlenja" required>
            <label for="korisnickoIme">Korisnicko ime</label>
                <input type="text" name="korisnickoIme" max_length="100" required>
            <label for="sifra">Sifra</label>
                <input type="password" name="sifra" requred max_length="100">
            <label for="radnoMjesto">Radno mjesto</label>
                <select name="mjesto" required>
                    <?php
                        require "../Classes/DatabaseClass.php";
                        $radnaMjesta = new Database;
                        $radnaMjesta->ispisiRadnaMjesta();
                    ?>
                </select>
                <button type="Submit">Dodaj</button>
        </form>
    </main>

    <?php require "../footer.php"; ?>
</body>
</html>