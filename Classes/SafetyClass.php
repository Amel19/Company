<?php
class Safety{
    public function provjeriUnos($unos){
        $this->unos = $unos;
		$this->unosNiz = str_split($this->unos);
		for($i = 0; $i < count($this->unosNiz); $i++){
			if($this->unosNiz[$i] == "'" || $this->unosNiz[$i] == '"'){
				$this->unosNiz[$i] = '\\' . $this->unosNiz[$i];
			}
		}
		$this->rezultat = implode($this->unosNiz);
		return $this->rezultat;	
    }
}

?>