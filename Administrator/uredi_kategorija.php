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
      if(is_null($provjeriId->provjeriPostojanjeID($id, 'firma_kategorija', 'kategorija_id'))){
        header("Location:index.php");
        exit();
      }
    }else{
        header("Location: kategorije.php");
    }
    $red = new Database;
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi kategorije</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Uredi kategorije</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>
    <main>
    <form action="zavrsi_uredi_kategorija.php" method="post">
        <label for="naziv">Naziv</label>
            <input type="text" value="<?php $red->dobaviRed('firma_kategorija', 'kategorija_id', $id, 'kategorija_naziv') ?>" name="naziv" max_length="100" required>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <button type="submit">Završi</button>
    </form>
    </main>
    <?php require "../footer.php"; ?>
</body>
</html>