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
      if(is_null($provjeriId->provjeriPostojanjeID($id, 'firma_poslovni_partner', 'partner_id'))){
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi poslovnog partnera</title>
    <link rel="stylesheet" href="../Source/Css/form.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
</head>
<body>
    <header>
        <h1>Uređivanje poslovnog partnera</h1>
        <div id="home">
            <a href="index.php">Početna</a>
        </div>
    </header>
    <main>
    <form action="zavrsi_uredi_partner.php" method="post">
    <label for="naziv">Naziv</label>
            <input type="text" name="naziv" max_length="100" value="<?php $red->dobaviRed('firma_poslovni_partner', 'partner_id', $id, 'naziv') ?>" required>
        <label for="adresa">Adresa</label>
            <input type="text" name="adresa" max_length="100" value="<?php $red->dobaviRed('firma_poslovni_partner', 'partner_id', $id, 'adresa') ?>" required>
        <label for="telefon">Telefon</label>
            <input type="text" name="telefon" max_length="50" value="<?php $red->dobaviRed('firma_poslovni_partner', 'partner_id', $id, 'telefon') ?>" required>
        <label for="telefax">Telefax</label>
            <input type="text" name="telefax" max_length="50" value="<?php $red->dobaviRed('firma_poslovni_partner', 'partner_id', $id, 'telefax') ?>" required>
        <label for="email">E-mail</label>
            <input type="email" name="email" max_length="50" value="<?php $red->dobaviRed('firma_poslovni_partner', 'partner_id', $id, 'email') ?>" required>
        <label for="partnerOd">Partner od</label>
            <input type="date" name="partnerOd" value="<?php $red->dobaviRed('firma_poslovni_partner', 'partner_id', $id, 'partner_od') ?>" required>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <button type="submit">Zavrsi</button>
    </form>
    </main>
    <?php require "../footer.php"; ?>
</body>
</html>