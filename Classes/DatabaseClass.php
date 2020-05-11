<?php
    require "ConnectionClass.php";

    class Database extends Connection{
        public function unesiZaposlenika($ime, $prezime, $adresa, $telefon, $email, $godine, $datumZaposlenja, $korisnickoIme, $sifra, $radnoMjesto){
            $this->ime = $ime;
            $this->prezime = $prezime;
            $this->adresa = $adresa;
            $this->telefon = $telefon;
            $this->email = $email;
            $this->godine = $godine;
            $this->datumZaposlenja = $datumZaposlenja;
            $this->korisnickoIme = $korisnickoIme;
            $this->sifra = $sifra;
            $this->radnoMjesto = $radnoMjesto;
            $this->status = 1;
            $this->kredencijali = 1;
            
            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO zaposlenik (zaposlenik_ime, zaposlenik_prezime, zaposlenik_adresa, zaposlenik_telefon, zaposlenik_email, zaposlenik_godine, zaposlenik_datum_zaposlenja, zaposlenik_korisnicko_ime, zaposlenik_sifra, zaposlenik_kredencijal_id, zaposlenik_status_id, zaposlenik_radno_mjesto_id) VALUES ('$this->ime', '$this->prezime', '$this->adresa', '$this->telefon', '$this->email', '$this->godine', '$this->datumZaposlenja', '$this->korisnickoIme', '$this->sifra', '$this->kredencijali', '$this->status', '$this->radnoMjesto')";
                $this->connection->exec($this->sql);
                header("Location:index.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function prikaziArtikle(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT a.artikl_id AS id, a.artikl_naziv AS naziv, a.artikl_opis AS opis, k.kategorija_naziv AS kategorija, a.cijena AS cijena, a.jedinicna_mjera AS mjera, a.zaliha AS zaliha FROM firma_artikl a JOIN firma_kategorija k ON a.artikl_kategorija_id = k.kategorija_id");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Naziv </th>";
                echo "<th> Opis </th>";
                echo "<th> Kategorija </th>";
                echo "<th> Cijena </th>";
                echo "<th> Jedinicna mjera </th>";
                echo "<th> Zaliha </th>";
                echo "<th> Izbrisi </th>";
                echo "<th> Uredi </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->artikl = $this->sql->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $this->artikl['id'] . ".</td>";
                echo "<td>" . $this->artikl['naziv'] . "</td>";
                echo "<td>" . $this->artikl['opis'] . "</td>";
                echo "<td>" . $this->artikl['kategorija'] . "</td>";
                echo "<td>" . $this->artikl['cijena'] . "</td>";
                echo "<td>" . $this->artikl['mjera'] . "</td>";
                echo "<td>" . $this->artikl['zaliha'] . "</td>";
                echo "<td><a href='izbrisi_artikl.php?id=" . $this->artikl['id'] . "'>Izbrisi</a></td>";
                echo "<td><a href='uredi_artikl.php?id=" . $this->artikl['id'] . "'>Uredi</a></td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->userInfoQuery . "<br>" . $a->getMessage();
            }
        }
        public function prikaziZaposlenike(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT z.zaposlenik_id AS id, z.zaposlenik_ime AS ime, z.zaposlenik_prezime AS prezime, z.zaposlenik_adresa AS adresa, z.zaposlenik_telefon AS telefon, z.zaposlenik_email AS email, z.zaposlenik_godine AS godine, z.zaposlenik_datum_zaposlenja AS datum, z.zaposlenik_korisnicko_ime AS korisnicko, k.kredencijal_ime AS kredencijal, s.status_ime AS status, rm.mjesto_ime AS mjesto FROM zaposlenik z JOIN kredencijal k ON z.zaposlenik_kredencijal_id = k.kredencijal_id JOIN firma_status s ON z.zaposlenik_status_id = s.status_id JOIN firma_radno_mjesto rm ON z.zaposlenik_radno_mjesto_id = rm.mjesto_id ORDER BY z.zaposlenik_id DESC");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Ime </th>";
                echo "<th> Prezime </th>";
                echo "<th> Adresa </th>";
                echo "<th> Telefon </th>";
                echo "<th> E-mail </th>";
                echo "<th> Godine </th>";
                echo "<th> Datum zaposl. </th>";
                echo "<th> Korisnicko i. </th>";
                echo "<th> Kredencijali </th>";
                echo "<th> Status </th>";
                echo "<th> Radno mj. </th>";
                echo "<th> Izbrisi </th>";
                echo "<th> Uredi </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->zaposlenik = $this->sql->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $this->zaposlenik['id'] . ".</td>";
                echo "<td>" . $this->zaposlenik['ime'] . "</td>";
                echo "<td>" . $this->zaposlenik['prezime'] . "</td>";
                echo "<td>" . $this->zaposlenik['adresa'] . "</td>";
                echo "<td>" . $this->zaposlenik['telefon'] . "</td>";
                echo "<td>" . $this->zaposlenik['email'] . "</td>";
                echo "<td>" . $this->zaposlenik['godine'] . "</td>";
                echo "<td>" . $this->zaposlenik['datum'] . "</td>";
                echo "<td>" . $this->zaposlenik['korisnicko'] . "</td>";
                echo "<td>" . $this->zaposlenik['kredencijal'] . "</td>";
                echo "<td>" . $this->zaposlenik['status'] . "</td>";
                echo "<td>" . $this->zaposlenik['mjesto'] . "</td>";
                echo "<td><a href='izbrisi_zaposlenog.php?id=" . $this->zaposlenik['id'] . "'>Izbrisi</a></td>";
                echo "<td><a href='uredi_zaposlenog.php?id=" . $this->zaposlenik['id'] . "'>Uredi</a></td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->userInfoQuery . "<br>" . $a->getMessage();
            }
        }
        public function prikaziPartnere(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT p.partner_id, p.naziv, p.adresa, p.telefon, p.telefax, p.email, p.partner_od, s.status_ime FROM firma_poslovni_partner p JOIN firma_status s ON p.partner_status_id = s.status_id ORDER BY p.partner_id DESC");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Naziv </th>";
                echo "<th> Adresa </th>";
                echo "<th> Telefon </th>";
                echo "<th> Telefax </th>";
                echo "<th> E-mail </th>";
                echo "<th> Partner od </th>";
                echo "<th> Status </th>";
                echo "<th> Izbrisi </th>";
                echo "<th> Uredi </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->partner = $this->sql->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $this->partner['partner_id'] . ".</td>";
                echo "<td>" . $this->partner['naziv'] . "</td>";
                echo "<td>" . $this->partner['adresa'] . "</td>";
                echo "<td>" . $this->partner['telefon'] . "</td>";
                echo "<td>" . $this->partner['telefax'] . "</td>";
                echo "<td>" . $this->partner['email'] . "</td>";
                echo "<td>" . $this->partner['partner_od'] . "</td>";
                echo "<td>" . $this->partner['status_ime'] . "</td>";
                echo "<td><a href='izbrisi_partnera.php?id=" . $this->partner['partner_id'] . "'>Izbrisi</a></td>";
                echo "<td><a href='uredi_partner.php?id=" . $this->partner['partner_id'] . "'>Uredi</a></td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->userInfoQuery . "<br>" . $a->getMessage();
            }
        }
        public function ispisiRadnaMjesta(){
                try {
                    parent::connection();
                    $this->sql = $this->connection->query("SELECT mjesto_id, mjesto_ime FROM firma_radno_mjesto");
                    while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value ='" . $this->row['mjesto_id'] . "'>" . $this->row['mjesto_ime'] . "</option>";
                    }
                }catch (PDOException $a) {
                    echo $this->sql . "<br>" . $a->getMessage();
                }  
        }
        public function kategorije(){
            try {
                parent::connection();
                $this->sql = $this->connection->query("SELECT * FROM firma_kategorija");
                while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value ='" . $this->row['kategorija_id'] . "'>" . $this->row['kategorija_naziv'] . "</option>";
                }
            }catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }  
        }
        public function ispisiPartnere(){
            try {
                parent::connection();
                $this->sql = $this->connection->query("SELECT partner_id, naziv FROM firma_poslovni_partner");
                while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value ='" . $this->row['partner_id'] . "'>" . $this->row['naziv'] . "</option>";
                }
            }catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }  
        }
        public function ispisiRadnaMjestaTabela(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT * FROM firma_radno_mjesto");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Naziv </th>";
                echo "<th> Opis </th>";
                echo "<th> Izbrisi </th>";
                echo "<th> Uredi </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->radnoMjesto = $this->sql->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $this->radnoMjesto['mjesto_id'] . ".</td>";
                echo "<td>" . $this->radnoMjesto['mjesto_ime'] . "</td>";
                echo "<td>" . $this->radnoMjesto['mjesto_opis'] . "</td>";
                echo "<td><a href='izbrisi_radnoMjesto.php?id=" . $this->radnoMjesto['mjesto_id'] . "'>Izbrisi</a></td>";
                echo "<td><a href='uredi_radno_mjesto.php?id=" . $this->radnoMjesto['mjesto_id'] . "'>Uredi</a></td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->userInfoQuery . "<br>" . $a->getMessage();
            }
        }
        public function ispisiKategorije(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT * FROM firma_kategorija");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Naziv </th>";
                echo "<th> Izbrisi </th>";
                echo "<th> Uredi </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->kategorija = $this->sql->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $this->kategorija['kategorija_id'] . ".</td>";
                echo "<td>" . $this->kategorija['kategorija_naziv'] . "</td>";
                echo "<td><a href='izbrisi_kategorija.php?id=" . $this->kategorija['kategorija_id'] . "'>Izbrisi</a></td>";
                echo "<td><a href='uredi_kategorija.php?id=" . $this->kategorija['kategorija_id'] . "'>Uredi</a></td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->userInfoQuery . "<br>" . $a->getMessage();
            }
        }
        public function ispisiTipovePlacanja(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT * FROM firma_tip_placanja");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Naziv </th>";
                echo "<th> Izbrisi </th>";
                echo "<th> Uredi </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->placanje = $this->sql->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $this->placanje['placanje_id'] . ".</td>";
                echo "<td>" . $this->placanje['placanje_naziv'] . "</td>";
                echo "<td><a href='izbrisi_tipPlacanja.php?id=" . $this->placanje['placanje_id'] . "'>Izbrisi</a></td>";
                echo "<td><a href='uredi_tipPlacanja.php?id=" . $this->placanje['placanje_id'] . "'>Uredi</a></td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->userInfoQuery . "<br>" . $a->getMessage();
            }
        }
        public function izbrisiZaposlenog($id){
            $this->id = $id;
            try{
                parent::connection();
                $this->sql = "UPDATE zaposlenik SET zaposlenik_status_id = 2 WHERE zaposlenik_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Refresh:1; url=index.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function unesiPoslovnogPartnera($naziv, $adresa, $telefon, $telefax, $email, $od){
            $this->naziv = $naziv;
            $this->adresa = $adresa;
            $this->telefon = $telefon;
            $this->telefax = $telefax;
            $this->email = $email;
            $this->od = $od;
            $this->status = 1;
            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO firma_poslovni_partner (naziv, adresa, telefon, telefax, email, partner_od, partner_status_id) VALUES ('$this->naziv', '$this->adresa', '$this->telefon', '$this->telefax', '$this->email', '$this->od', '$this->status')";
                $this->connection->exec($this->sql);
                header("Location:poslovniPartneri.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function izbrisiPoslovnogPartnera($id){
            $this->id = $id;
            try{
                parent::connection();
                $this->sql = "UPDATE firma_poslovni_partner SET partner_status_id = 2 WHERE partner_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Refresh:1; url=poslovniPartneri.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function urediPoslovnogPartnera($id, $naziv, $adresa, $telefon, $telefax, $email, $od){
            $this->id = $id;
            $this->naziv = $naziv;
            $this->adresa = $adresa;
            $this->telefon = $telefon;
            $this->telefax = $telefax;
            $this->email = $email;
            $this->od = $od;
            try {
                parent::connection();
                $this->sql = "UPDATE firma_poslovni_partner SET naziv = '$this->naziv', adresa = '$this->adresa', telefon = '$this->telefon', telefax = '$this->telefax', email = '$this->email', partner_od = '$this->od' WHERE partner_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Location:poslovniPartneri.php");
            } catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function urediArtikl($id, $naziv, $opis, $kategorija, $cijena, $jedinicnaMjera, $zaliha){
            $this->id = $id;
            $this->naziv = $naziv;
            $this->opis = $opis;
            $this->kategorija = $kategorija;
            $this->cijena = $cijena;
            $this->jedinicnaMjera = $jedinicnaMjera;
            $this->zaliha = $zaliha;
            try {
                parent::connection();
                $this->sql = "UPDATE firma_artikl SET artikl_naziv = '$this->naziv', artikl_opis = '$this->opis', artikl_kategorija_id = '$this->kategorija', cijena = '$this->cijena', jedinicna_mjera = '$this->jedinicnaMjera', zaliha = '$this->zaliha' WHERE artikl_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Location:artikli.php");
            } catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function urediZaposlenika($id, $ime, $prezime, $adresa, $telefon, $email, $godine, $datumZaposlenja, $korisnickoIme, $radnoMjesto){
            $this->id = $id;
            $this->ime = $ime;
            $this->prezime = $prezime;
            $this->adresa = $adresa;
            $this->telefon = $telefon;
            $this->email = $email;
            $this->godine = $godine;
            $this->datumZaposlenja = $datumZaposlenja;
            $this->korisnickoIme = $korisnickoIme;
            $this->radnoMjesto = $radnoMjesto;

            try {
                parent::connection();
                $this->sql = "UPDATE zaposlenik SET zaposlenik_ime = '$this->ime', zaposlenik_prezime = '$this->prezime',zaposlenik_adresa = '$this->adresa', zaposlenik_telefon = '$this->telefon', zaposlenik_email = '$this->email', zaposlenik_godine = '$this->godine', zaposlenik_datum_zaposlenja = '$this->datumZaposlenja', zaposlenik_korisnicko_ime = '$this->korisnickoIme', zaposlenik_radno_mjesto_id = '$this->radnoMjesto' WHERE zaposlenik_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Location:zaposlenici.php");
            } catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function urediRadnoMjesto($id, $naziv, $opis){
            $this->id = $id;
            $this->naziv = $naziv;
            $this->opis = $opis;
            try {
                parent::connection();
                $this->sql = "UPDATE firma_radno_mjesto SET mjesto_ime = '$this->naziv', mjesto_opis = '$this->opis' WHERE mjesto_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Location:radnoMjesto.php");
            } catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function urediKategorije($id, $naziv){
            $this->id = $id;
            $this->naziv = $naziv;
            try {
                parent::connection();
                $this->sql = "UPDATE firma_kategorija SET kategorija_naziv = '$this->naziv' WHERE kategorija_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Location:kategorije.php");
            } catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function urediTipPlacanja($id, $naziv){
            $this->id = $id;
            $this->naziv = $naziv;
            try {
                parent::connection();
                $this->sql = "UPDATE firma_tip_placanja SET placanje_naziv = '$this->naziv' WHERE placanje_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Location:tipPlacanja.php");
            } catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function dobaviRed($tabela, $sta, $id, $vrijednost){
            $this->tabela = $tabela;
            $this->sta = $sta;
            $this->id = $id;
            $this->vrijednost = $vrijednost;
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT * FROM " . $this->tabela . " WHERE " . $this->sta . " = $this->id");
                while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    echo $this->row[$this->vrijednost];
                }
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function dodajArtikal($naziv, $opis, $kategorija, $cijena, $jedinicnaMjera, $zaliha){
            $this->naziv = $naziv;
            $this->opis = $opis;
            $this->kategorija = $kategorija;
            $this->cijena = $cijena;
            $this->jedinicnaMjera = $jedinicnaMjera;
            $this->zaliha = $zaliha;

            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO firma_artikl (artikl_naziv, artikl_opis, artikl_kategorija_id, cijena, jedinicna_mjera, zaliha) VALUES ('$this->naziv', '$this->opis', '$this->kategorija', '$this->cijena', '$this->jedinicnaMjera', '$this->zaliha')";
                $this->connection->exec($this->sql);
                header("Location:index.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function dodajRadnoMjesto($naziv, $opis){
            $this->naziv = $naziv;
            $this->opis = $opis;

            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO firma_radno_mjesto (mjesto_ime, mjesto_opis) VALUES ('$this->naziv', '$this->opis')";
                $this->connection->exec($this->sql);
                header("Location:radnoMjesto.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function dodajTipPlacanja($naziv){
            $this->naziv = $naziv;
            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO firma_tip_placanja (placanje_id, placanje_naziv) VALUES (null, '$this->naziv')";
                $this->connection->exec($this->sql);
                header("Location:tipPlacanja.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function dodajKategoriju($naziv){
            $this->naziv = $naziv;
            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO firma_kategorija (kategorija_id, kategorija_naziv) VALUES (null, '$this->naziv')";
                $this->connection->exec($this->sql);
                header("Location:kategorije.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function izbrisiRadnoMjesto($id){
            $this->id = $id;
            try{
                parent::connection();
                $this->sql = "DELETE FROM firma_radno_mjesto WHERE mjesto_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Refresh:1; url=radnoMjesto.php");
            }catch(PDOException $a){
                echo "Radno mjesto se koristi u drugoj tabeli. Brisanje trenutno nije moguće.";
            }
        }
        public function izbrisiKategoriju($id){
            $this->id = $id;
            try{
                parent::connection();
                $this->sql = "DELETE FROM firma_kategorija WHERE kategorija_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Refresh:1; url=kategorije.php");
            }catch(PDOException $a){
                echo "Kategorija se koristi u drugoj tabeli. Brisanje trenutno nije moguće.";
            }
        }
        public function izbrisiTipPlacanja($id){
            $this->id = $id;
            try{
                parent::connection();
                $this->sql = "DELETE FROM firma_tip_placanja WHERE placanje_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Refresh:1; url=tipPlacanja.php");
            }catch(PDOException $a){
                echo "Tip placanja se koristi. Brisanje nije moguće.";
            }
        }
        public function izbrisiArtikal($id){
            $this->id = $id;
            try{
                parent::connection();
                $this->sql = "DELETE FROM firma_artikl WHERE artikl_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Refresh:1; url=index.php");
            }catch(PDOException $a){
                echo "Artikl se koristi u drugim tabelama. Brisanje nije moguće.";
            }
        }
        public function naruci($partner, $naziv, $mjera, $kolicina){
            $this->partner = $partner;
            $this->naziv = $naziv;
            $this->mjera = $mjera;
            $this->kolicina = $kolicina;
            $this->status = 3;
            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO firma_narudzba (narudzba_poslovni_partner_id, naziv_artikl, jedinicna_mjera, kolicina, narudzba_status_id) VALUES ('$this->partner', '$this->naziv', '$this->mjera', '$this->kolicina', '$this->status')";
                $this->connection->exec($this->sql);
                header("Location:index.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function prikaziNarudzbe(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT n.narudzba_id, n.naziv_artikl, n.jedinicna_mjera, n.kolicina, n.datum, s.status_ime, p.naziv FROM firma_narudzba n JOIN firma_poslovni_partner p ON n.narudzba_poslovni_partner_id = p.partner_id JOIN firma_status s ON n.narudzba_status_id = s.status_id ORDER BY n.narudzba_id DESC");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Poslovni partner </th>";
                echo "<th> Naziv artikla </th>";
                echo "<th> Jedinicna mjera </th>";
                echo "<th> Kolicina </th>";
                echo "<th> Status </th>";
                echo "<th> Datum </th>";
                echo "<th> Izbrisi </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->narudzba = $this->sql->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $this->narudzba['narudzba_id'] . ".</td>";
                echo "<td>" . $this->narudzba['naziv'] . "</td>";
                echo "<td>" . $this->narudzba['naziv_artikl'] . "</td>";
                echo "<td>" . $this->narudzba['jedinicna_mjera'] . "</td>";
                echo "<td>" . $this->narudzba['kolicina'] . "</td>";
                echo "<td>" . $this->narudzba['status_ime'] . "</td>";
                echo "<td>" . $this->narudzba['datum'] . "</td>";
                echo "<td><a href='izbrisi_narudzba.php?id=" . $this->narudzba['narudzba_id'] . "'>Izbrisi</a></td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->userInfoQuery . "<br>" . $a->getMessage();
            }
        }
        public function prikaziNarudzbeZaposlenik(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT n.narudzba_id, n.naziv_artikl, n.jedinicna_mjera, n.kolicina, n.datum, p.naziv FROM firma_narudzba n JOIN firma_poslovni_partner p ON n.narudzba_poslovni_partner_id = p.partner_id");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> Poslovni partner </th>";
                echo "<th> Naziv artikla </th>";
                echo "<th> Jedinicna mjera </th>";
                echo "<th> Kolicina </th>";
                echo "<th> Datum </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->narudzba = $this->sql->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . $this->narudzba['narudzba_id'] . ".</td>";
                echo "<td>" . $this->narudzba['naziv'] . "</td>";
                echo "<td>" . $this->narudzba['naziv_artikl'] . "</td>";
                echo "<td>" . $this->narudzba['jedinicna_mjera'] . "</td>";
                echo "<td>" . $this->narudzba['kolicina'] . "</td>";
                echo "<td>" . $this->narudzba['datum'] . "</td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function prikaziPrimke(){
            try{
                parent::connection();
                $this->sql = $this->connection->query("SELECT p.primka_id, p.narudzba_id, p.kolicina, p.datum, fp.naziv, n.naziv_artikl FROM firma_narudzba_primka p JOIN firma_narudzba n ON p.narudzba_id = n.narudzba_id JOIN firma_poslovni_partner fp ON n.narudzba_poslovni_partner_id = fp.partner_id");
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> ID </th>";
                echo "<th> ID Narudzba </th>";
                echo "<th> Poslovni partner </th>";
                echo "<th> Naziv artikla </th>";
                echo "<th> Kolicina </th>";
                echo "<th> Datum </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($this->primka = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    
                echo "<tr>";
                echo "<td>" . $this->primka['primka_id'] . ".</td>";
                echo "<td>" . $this->primka['narudzba_id'] . "</td>";
                echo "<td>" . $this->primka['naziv'] . "</td>";
                echo "<td>" . $this->primka['naziv_artikl'] . "</td>";
                echo "<td>" . $this->primka['kolicina'] . "</td>";
                echo "<td>" . $this->primka['datum'] . "</td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function ispisiNarudzbe(){
            try {
                parent::connection();
                $this->sql = $this->connection->query("SELECT narudzba_id, naziv_artikl FROM firma_narudzba WHERE narudzba_status_id = 3");
                while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value ='" . $this->row['narudzba_id'] . "'>" . $this->row['naziv_artikl'] . "</option>";
                }
            }catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }  
        }
        public function izbrisiNarudzbu($id){
            $this->id = $id;
            try{
                parent::connection();
                $this->sql = "DELETE FROM firma_narudzba WHERE narudzba_id = '$this->id'";
                $this->connection->exec($this->sql);
                header("Refresh:1; url=index.php");
            }catch(PDOException $a){
                echo "Narudzba se koristi u drugim tabelama. Brisanje nije moguće.";
            }
        }
        public function primkaNarudzbe($narudzbaId, $kolicina){
            $this->narudzbaId = $narudzbaId;
            $this->kolicina = $kolicina;

            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO firma_narudzba_primka (narudzba_id, kolicina) VALUES ('$this->narudzbaId', '$this->kolicina')";
                $this->connection->exec($this->sql);
                header("Location:index.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function potvrdiPrimku($narudzbaId){
            $this->narudzbaId = $narudzbaId;

            try{
                parent::connection();
                $this->sql = "UPDATE firma_narudzba SET narudzba_status_id = 4 WHERE narudzba_id = '$this->narudzbaId'";
                $this->connection->exec($this->sql);
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function prikaziTipovePlacanja(){
            try {
                parent::connection();
                $this->sql = $this->connection->query("SELECT * FROM firma_tip_placanja");
                while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value ='" . $this->row['placanje_id'] . "'>" . $this->row['placanje_naziv'] . "</option>";
                }
            }catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }  
        }
        public function ispisiArtikl(){
            try {
                parent::connection();
                $this->sql = $this->connection->query("SELECT artikl_id, artikl_naziv FROM firma_artikl WHERE zaliha > 0");
                while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value ='" . $this->row['artikl_id'] . "'>" . $this->row['artikl_naziv'] . "</option>";
                }
            }catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }  
        }
        public function dobaviCijenu($id){
            $this->id = $id;

            try {
                parent::connection();
                $this->sql = $this->connection->query("SELECT cijena FROM firma_artikl WHERE artikl_id ='$this->id'");
                while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    $this->cijena = $this->row['cijena'];
                    echo $this->cijena;
                }
            }catch (PDOException $a) {
                echo $this->sql . "<br>" . $a->getMessage();
            }  
        }
        public function ubaciRacun($zaposlenikId, $tipPlacanja, $komentar, $total, $uplaceno){
            $this->zaposlenikId = $zaposlenikId;
            $this->tipPlacanja = $tipPlacanja;
            $this->komentar = $komentar;
            $this->total = $total;
            $this->uplaceno = $uplaceno;

            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO racun (racun_zaposlenik_id, racun_tip_placanja_id, komentar, total, uplaceno) VALUES ('$this->zaposlenikId', '$this->tipPlacanja', '$this->komentar', '$this->total', '$this->uplaceno')";
                $this->connection->exec($this->sql);
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function dodajStavke($racunId, $artiklId, $kolicina){
            $this->racunId = $racunId;
            $this->artiklId = $artiklId;
            $this->kolicina = $kolicina;

            try{
                #Connect to the database
                parent::connection();
                $this->sql = "INSERT INTO racun_stavka (racun_id, artikl_id, kolicina) VALUES ('$this->racunId', '$this->artiklId', '$this->kolicina')";
                $this->connection->exec($this->sql);
               
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function dobaviIdRacuna(){
            try{
                #Connect to the database
                parent::connection();
                $this->sql = $this->connection->query("SELECT MAX(racun_id) AS id FROM racun");
                $this->racun = $this->sql->fetch(PDO::FETCH_ASSOC);
                return $this->racun['id'];
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function oduzmiKolicinu($artiklId, $kolicina){
            $this->artiklId = $artiklId;
            $this->kolicina = $kolicina;
            try{
                #Connect to the database
                parent::connection();
                $this->sql = "UPDATE firma_artikl SET zaliha = zaliha-$this->kolicina WHERE artikl_id='$this->artiklId'";
                $this->connection->exec($this->sql);
                header("Location:index.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function ispisiRacune(){
            try{
                #Connect to the database
                parent::connection();
                $this->sql = $this->connection->query("SELECT r.racun_id, z.zaposlenik_korisnicko_ime AS zaposlenik, p.placanje_naziv AS placanje, r.komentar, r.datum, r.total, r.uplaceno FROM racun r JOIN zaposlenik z ON r.racun_zaposlenik_id = z.zaposlenik_id JOIN firma_tip_placanja p ON r.racun_tip_placanja_id = p.placanje_id ORDER BY r.racun_id DESC");
                $this->i = 0;
                while($this->row = $this->sql->fetch(PDO::FETCH_ASSOC)){
                    $this->i++;
                    $this->sql2 = $this->connection->query("SELECT a.artikl_naziv AS artikl, a.cijena, a.jedinicna_mjera, rs.kolicina FROM firma_artikl a JOIN racun_stavka rs ON a.artikl_id = rs.artikl_id WHERE rs.racun_id=" . $this->row['racun_id']);
                    echo "<div id='racunInfo" . $this->i . "' onClick=\"prikaziRacun(" . $this->i . ")\" class='info'>";
                        echo "<p>Račun ID: " . $this->row['racun_id'] . "</p>";
                        echo "<i>" . $this->row['datum'] . "</i>";
                    echo "</div>";
                    
                    echo "<div id='racunSadrzaj" . $this->i . "' class='sadrzaj' style='display:none;'>";
                    echo "<table>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th> Naziv </th>";
                            echo "<th> Cijena </th>";
                            echo "<th> Jedinicna mjera </th>";
                            echo "<th> Kolicina </th>";
                        echo "<tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($this->row2 = $this->sql2->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                            echo "<td>" . $this->row2['artikl'] . "</td>";
                            echo "<td>" . $this->row2['cijena'] . "</td>";
                            echo "<td>" . $this->row2['jedinicna_mjera'] . "</td>";
                            echo "<td>" . $this->row2['kolicina'] . "</td>";
                        echo "<tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                        echo "<div id='ostaloInfo'>";
                            echo "<p>Izdao: <span class='color'>" . $this->row['zaposlenik'] . "</span></p>";
                            echo "<p>Tip plaćanja: <span class='color'>" . $this->row['placanje'] . "</span></p>";
                            echo "<p>Total: <span class='color'>" . $this->row['total'] . " </span> KM</p>";
                            echo "<p>Uplaćeno: <span class='color'>" . $this->row['uplaceno'] . "</span> KM</p>";
                            echo "<p>Komentar: <span class='color'>" . $this->row['komentar'] . " </span></p>";
                        echo "</div>";
                    echo "</div>";
                    
                }
                #header("Location:index.php");
            }catch(PDOException $a){
                echo $this->sql . "<br>" . $a->getMessage();
            }
        }
        public function provjeriPostojanjeID($id, $table, $what){
            $this->id = $id;
            $this->table = $table;
            $this->what = $what;
                if(is_numeric($this->id)){
                    try {
                        parent::connection();
                        $this->check = $this->connection->query("SELECT " .  $this->what . " AS id FROM " . $this->table . " WHERE " . $this->what . " = '$this->id'");
                        $this->ids = $this->check->fetch(PDO::FETCH_ASSOC);
                        return $this->ids['id'];
                    } catch (PDOException $a) {
                        echo $this->check . "<br>" . $a->getMessage();
                    }
                }
        }
    }
?>