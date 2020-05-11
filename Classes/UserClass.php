<?php
    require "ConnectionClass.php";

    class User extends Connection{
        public $checkMatchingQuery;
        public $userExists;

        public function login($username, $password){
            $this->username = $username;
            $this->password = $password;
            $this->passwordHash = md5(md5($this->password));
            try{
                parent::connection();
                
                $this->checkMatchingQuery = $this->connection->query("SELECT count(zaposlenik_id) AS matching FROM zaposlenik WHERE zaposlenik_korisnicko_ime = '$this->username' AND zaposlenik_sifra = '$this->passwordHash'");
                $this->userExists = $this->checkMatchingQuery->fetch(PDO::FETCH_ASSOC);
    
                if($this->userExists['matching'] !== '0'){
                    $this->checkCredentials = $this->connection->query("SELECT zaposlenik_kredencijal_id AS credentials FROM zaposlenik WHERE zaposlenik_korisnicko_ime = '$this->username' AND zaposlenik_sifra = '$this->passwordHash'");
                    $this->credentials = $this->checkCredentials->fetch(PDO::FETCH_ASSOC);
                    switch ($this->credentials['credentials']) {
                        case '1':
                            $this->sessionQuery = $this->connection->query("SELECT zaposlenik_id, zaposlenik_kredencijal_id AS credentials, zaposlenik_korisnicko_ime AS korisnicko FROM zaposlenik WHERE zaposlenik_korisnicko_ime = '$this->username' AND zaposlenik_sifra = '$this->passwordHash'");
                            $this->sessionData = $this->sessionQuery->fetch(PDO::FETCH_ASSOC);
                            session_start();
                                $_SESSION['zaposlenik_id'] = $this->sessionData['zaposlenik_id'];
                                $_SESSION['zaposlenik_credentials'] = $this->sessionData['credentials'];
                                $_SESSION['korisnicko'] = $this->sessionData['korisnicko'];
                            header("Location:Zaposlenik/index.php");
                            break;
                        case '2':
                            $this->sessionQuery = $this->connection->query("SELECT zaposlenik_id, zaposlenik_kredencijal_id AS credentials FROM zaposlenik WHERE zaposlenik_korisnicko_ime = '$this->username' AND zaposlenik_sifra = '$this->passwordHash'");
                            $this->sessionData = $this->sessionQuery->fetch(PDO::FETCH_ASSOC);
                            session_start();
                                $_SESSION['zaposlenik_id'] = $this->sessionData['zaposlenik_id'];
                                $_SESSION['zaposlenik_credentials'] = $this->sessionData['credentials'];
                            header("Location:Administrator/index.php");
                            break;
                        default:
                            header("location:index.php");
                            break;
                    }
                }else{
                header("location:index.php");
              }
            }catch(PDOException $a){
                echo "jd";
            }
        }
    }
?>