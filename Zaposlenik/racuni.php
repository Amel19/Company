<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 1 ? : header("Location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Svi računi</title>
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/footer.css">
    <link rel="stylesheet" href="../Source/Css/racun.css">
</head>
<body>
  <header>
    <h1>Svi računi</h1>
    <div id="home">
      <a href="index.php">Početna</a>
    </div>
  </header>
  <main>
    <?php
      require "../Classes/DatabaseClass.php";
      $racun = new Database;
      $racun->ispisiRacune();
    ?>
  </main>
  <?php require "../footer.php"; ?>
  <script>
    function prikaziRacun(IDBroj){
        var racun = document.getElementById("racunSadrzaj"+IDBroj);
        if(racun.style.display === "none"){
            racun.style.display = "block";  
        }else{
            racun.style.display = "none";
        }
    }
</script>
</body>
</html>