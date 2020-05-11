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
      if(is_null($provjeriId->provjeriPostojanjeID($id, 'firma_radno_mjesto', 'mjesto_id'))){
        header("Location:index.php");
        exit();
      }
    }else{
        header("Location: radnoMjesto.php");
    }
    $red = new Database;
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi radna mjesta</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Uredi radna mjesta</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>
    <main>
    <form action="zavrsi_uredi_radnoMjesto.php" method="post">
        <label for="naziv">Naziv</label>
            <input type="text" value="<?php $red->dobaviRed('firma_radno_mjesto', 'mjesto_id', $id, 'mjesto_ime') ?>" name="naziv" max_length="50" required>
        <label for="opis">Opis</label>
            <input type="text" value="<?php $red->dobaviRed('firma_radno_mjesto', 'mjesto_id', $id, 'mjesto_opis') ?>" name="opis" max_length="500" required>    
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <button type="submit">Završi</button>
    </form>
    </main>
    <?php require "../footer.php"; ?>
</body>
</html>