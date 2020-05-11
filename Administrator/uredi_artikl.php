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
      if(is_null($provjeriId->provjeriPostojanjeID($id, 'firma_artikl', 'artikl_id'))){
        header("Location:index.php");
        exit();
      }
    }else{
        header("Location: poslovniPartneri.php");
    }
    $red = new Database;
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Uredi artikl</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Uredi artikl</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>
    <main>
    <form action="zavrsi_uredi_artikl.php" method="post">
    <label for="naziv">Naziv</label>
            <input type="text" name="naziv" max_length="100" value="<?php $red->dobaviRed('firma_artikl', 'artikl_id', $id, 'artikl_naziv') ?>" required>
        <label for="opis">Opis</label>
            <input type="text" name="opis" max_length="500" value="<?php $red->dobaviRed('firma_artikl', 'artikl_id', $id, 'artikl_opis') ?>" required>
            <label for="kategorija">Kategorija</label>
            <select name="kategorija" required>
            <option value="" disabled selected>Odaberi kategoriju</option>
            <?php
                
                $kategorije = new Database;
                $kategorije->kategorije();
            ?>
            </select>
            <label for="cijena">Cijena</label>
            <input type="number" name="cijena" value="<?php $red->dobaviRed('firma_artikl', 'artikl_id', $id, 'cijena') ?>" step="0.01" min="0.01" max="99.99" required>
        <label for="jedinicnaMjera">Jedinicna mjera</label>
            <input type="text" value="<?php $red->dobaviRed('firma_artikl', 'artikl_id', $id, 'jedinicna_mjera') ?>" name="jedinicnaMjera" required>
        <label for="zaliha">Zaliha</label>
            <input type="number" value="<?php $red->dobaviRed('firma_artikl', 'artikl_id', $id, 'zaliha') ?>" name="zaliha" required>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <button type="submit">Završi</button>
    </form>
    </main>
    <?php require "../footer.php"; ?>
</body>
</html>