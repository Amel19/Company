<?php
  session_start();
  $korisnik_id = $_SESSION['zaposlenik_id'];
  $kredencijali = $_SESSION['zaposlenik_credentials'];
  $korisnik = $_SESSION['korisnicko'];
  isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
  $kredencijali == 1 ? : header("Location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unos racuna</title>
  <link rel="stylesheet" href="../Source/Css/footer.css">
    <link rel="stylesheet" href="../Source/Css/header.css">
    <link rel="stylesheet" href="../Source/Css/racun2.css">
</head>
<body>
  <header>
    <h1>Unos računa</h1>
    <div id="home">
      <a href="index.php">Početna</a>
    </div>
    <p>Zaposlenik id: <?php echo $korisnik_id; ?></p>
    <p>Zaposlenik ime: <?php echo $korisnik; ?></p>
  </header>
  <main>
    <form onmousemove="prebrojiArtikle()" action="zavrsi_racun.php" method="post">
    <div id="buttons">
        <button type="button" id="dodajArtikl" title="Dodaj artikl">+</button>
        <button type="button" id="obrisiArtikl" title="Oduzmi artikl">-</button>
      </div>
      <label for="artikl">Artikli</label>
      <div id="itemWrapper">
        <div id="item1" class="item">
          <select name="artikl1" onchange="dobaviCijenu(event)" id="artikl1" required>
          <option value = "" disabled selected>Odaberi artikl</option>
            <?php
             require "../Classes/DatabaseClass.php";
              $artikl = new Database;
              $artikl->ispisiArtikl();
            ?>
          </select>
          <label for="kolicina">Kolicina</label>
          <input type="number" id="kolicinaartikl1" value="1" name="kolicina1" min="1" required>
          <div class='priceAndTotal'>
          <label for="cijena">Cijena</label>
          <input type="text" value="0.00" id="cijenaartikl1" disabled>
          <label for="totalCijena">Total</label>
          <input type="text" value="0.00" id="1" disabled>
          </div>
        </div>
      </div>
      <input type="hidden" id="brojArtikala" name="brojArtikala"> 
      <label for="tipPlacanja">Odaberite tip placanja</label>
      <select name="placanje" required>
        <?php
       
        $tipPlacanja = new Database;
        $tipPlacanja->prikaziTipovePlacanja();
        ?>
      </select>
      <label for="komentar">Komentar</label>
      <input type="text" name="komentar" max_length="200" required>
      <label for="total">Total</label>
      <input type="text" value="0.00" id="total" name="total" max_length="50" required>
      <label for="uplaceno">Uplaceno</label>
      <input type="text" name="uplaceno" max_length="50" required>
      <button type="button" id="sumi" onclick="sumiraj()">Sumiraj</button>
      <button type="submit">Potvrdi racun</button>
    </form>
  </main>
  <?php require "../footer.php"; ?>
   <script>
      (function() {
        var dodaj = document.getElementById('dodajArtikl');
        var dodajArtikal = function() {
            var wrapper = document.createElement('div');
            var artikli = document.getElementById('itemWrapper');
            var select = document.createElement('select');
            var label = document.createElement('label');
            var kolicina = document.createElement('input');
            var label2 = document.createElement('label');
            var cijena = document.createElement('input');
            var option = document.createElement('option');
            var label3 = document.createElement('label');
            var cijenaTotal = document.createElement('input');
            var div2 = document.createElement('div');
            if(artikli.childElementCount < 10){
              option.setAttribute('disabled', 'disabled');
              option.setAttribute('value', '');
              option.setAttribute('selected', 'selected');
              cijena.id = 'cijenaartikl' + (artikli.childElementCount + 1);
              cijena.setAttribute('type', 'text');
              cijena.setAttribute('disabled', 'disabled');
              cijena.setAttribute('value', '0.00');

              cijenaTotal.id = artikli.childElementCount + 1;
              cijenaTotal.setAttribute('type', 'text');
              cijenaTotal.setAttribute('disabled', 'disabled');
              cijenaTotal.setAttribute('value', '0.00');

              div2.className = 'priceAndTotal';
            select.id = 'artikl' + (artikli.childElementCount + 1);
            select.setAttribute('name', 'artikl' + (artikli.childElementCount + 1));
            select.setAttribute('required', 'required');
            select.setAttribute('onchange', "dobaviCijenu(event)");
            label.setAttribute('for', 'kolicina');
            label2.setAttribute('for', 'cijena');
            label3.setAttribute('for', 'totalCijena');
            kolicina.setAttribute('type', 'number');
            kolicina.setAttribute('name', 'kolicina' + (artikli.childElementCount + 1));
            kolicina.setAttribute('min', '1');
            kolicina.setAttribute('required', 'required');
            kolicina.setAttribute('value', '1');
            kolicina.id = "kolicinaartikl" + (artikli.childElementCount + 1);
            wrapper.id = 'item' + (artikli.childElementCount + 1);
            wrapper.className = 'item';
            select.innerHTML = artikli.childNodes[1].childNodes[1].innerHTML;
            label.innerHTML = "Kolicina";
            label2.innerHTML = "Cijena";
            label3.innerHTML = "Total";
            artikli.appendChild(wrapper);
            wrapper.appendChild(select);          
            wrapper.appendChild(label);
            wrapper.appendChild(kolicina);
            wrapper.appendChild(div2);
            div2.appendChild(label2);
            div2.appendChild(cijena);
            div2.appendChild(label3);
            div2.appendChild(cijenaTotal);
            }
        };
        dodaj.addEventListener('click', function() {
            dodajArtikal();
        }.bind(this));
    })();
    (function() {
      var obrisi = document.getElementById('obrisiArtikl');
      var artikli = document.getElementById('itemWrapper');
      var izbrisiArtikl = function() {
          if(artikli.childElementCount  > 1){
            artikli.removeChild(artikli.childNodes[artikli.childElementCount + 1]);
          }
      };
      obrisi.addEventListener('click', function() {
        izbrisiArtikl();
      }.bind(this));
    })();
    function prebrojiArtikle(){
        var artikli = document.getElementById("itemWrapper");
        var brojArtikala = document.getElementById("brojArtikala");
        brojArtikala.value = artikli.childElementCount;
    }
    function dobaviCijenu(e){
      var cijena = document.getElementById("cijena" + e.target.id);
      var kolicina = document.getElementById("kolicina" + e.target.id);
      var total = document.getElementById("total");
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "cijena.php?id=" +e.target.value, true);
        xmlhttp.send("text");
      
        xmlhttp.onreadystatechange = function(){
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
              cijena.value = Number(xmlhttp.responseText * kolicina.value).toFixed(2);
          }
        }; 
      }
      function sumiraj(){
        var artikli = document.getElementById("brojArtikala").value;
        var total = document.getElementById("total");
        var ukupno = 0.00;
        for(var i = 1; i <= artikli; i++){
          var cijena = document.getElementById("cijenaartikl"+i);
          var kolicina = document.getElementById("kolicinaartikl"+i);
          var totalArtikl = document.getElementById(i);
          totalArtikl.value = Number(parseInt(cijena.value) * parseInt(kolicina.value)).toFixed(2);
          ukupno = Number(parseInt(totalArtikl.value) + parseInt(ukupno)).toFixed(2);
        }
        total.value = ukupno;
      }
      function ukupnaCijena(e){
          var cijena = document.getElementById("cijenaartikl"+e.target)
      }
     
    </script>
</body>
</html>