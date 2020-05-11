<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 2 ? : header("Location:../index.php");
    if(isset($_GET['id']) && !empty($_GET['id'])){
        require "../Classes/DatabaseClass.php";
        $id = $_GET['id'];
        $provjeriId = new Database;
      if(is_null($provjeriId->provjeriPostojanjeID($id, 'zaposlenik', 'zaposlenik_id'))){
        header("Location:index.php");
        exit();
      }
    }else{
        header("Location: zaposlenici.php");
    }
    $red = new Database;
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi zaposlenika</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Uredi zaposlenika</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>
    <main>
    <form action="zavrsi_uredi_zaposlenog.php" method="post">
    <label for="ime">Ime</label>
            <input type="text"  value="<?php $red->dobaviRed('zaposlenik', 'zaposlenik_id', $id, 'zaposlenik_ime') ?>" name="ime" max_length="100" required>
        <label for="prezime">Prezime</label>
            <input type="text" value="<?php $red->dobaviRed('zaposlenik', 'zaposlenik_id', $id, 'zaposlenik_prezime') ?>" name="prezime" max_length="100" required>
        <label for="adresa">Adresa</label>
            <input type="text" value="<?php $red->dobaviRed('zaposlenik', 'zaposlenik_id', $id, 'zaposlenik_adresa') ?>" name="adresa" max_length="100" required>
        <label for="telefon">Telefon</label>
            <input type="text" value="<?php $red->dobaviRed('zaposlenik', 'zaposlenik_id', $id, 'zaposlenik_telefon') ?>" name="telefon" max_length="100" required>
        <label for="email">E-mail</label>
            <input type="email" value="<?php $red->dobaviRed('zaposlenik', 'zaposlenik_id', $id, 'zaposlenik_email') ?>" name="email" max_length="100" required>
        <label for="godine">Godine</label>
            <input type="number" value="<?php $red->dobaviRed('zaposlenik', 'zaposlenik_id', $id, 'zaposlenik_godine') ?>" name="godine" min="1" max="70" required>
        <label for="datumZaposlenja">Datum Zaposlenja</label>
            <input type="date" value="<?php $red->dobaviRed('zaposlenik', 'zaposlenik_id', $id, 'zaposlenik_datum_zaposlenja') ?>" name="datumZaposlenja" required>
        <label for="korisnickoIme">Korisnicko ime</label>
            <input type="text" value="<?php $red->dobaviRed('zaposlenik', 'zaposlenik_id', $id, 'zaposlenik_korisnicko_ime') ?>" name="korisnickoIme" max_length="100" required>
        <label for="radnoMjesto">Radno mjesto</label>
            <select name="mjesto" required>
                <option value="" selected disabled>Odaberi radno mjesto</option>
                <?php
                    $radnaMjesta = new Database;
                    $radnaMjesta->ispisiRadnaMjesta();
                ?>
            </select>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="Submit">Dodaj</button>
    </form>
    </main>
    <?php require "../footer.php"; ?>
</body>
</html>