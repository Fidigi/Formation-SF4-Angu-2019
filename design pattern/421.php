<?php

/*
[1-6]*3
4-2-1
*/

Class QuatreCentVinghtEtUn
{
	private $rLance = array();
	private $rGarde = array();
	private $aCheck = [4, 2, 1];
	private $nbLance = 0;
	public $whaou = 0;

	public function LanceDe(int $n){
		unset($this->rLance);
		for ($i=0; $i < $n; $i++) { 
			$this->rLance[$i] = rand(1,6);
		}
		$this->nbLance ++;
		$this->CheckDe();
	}

	public function CheckDe(){
		$relance = 0;
		foreach($this->rLance as $value){
			if(in_array($value, $this->aCheck) && !in_array($value, $this->rGarde)){
				array_push($this->rGarde, $value);
			}
			else {
				$relance ++;
			}
		}

		//self::AffLance($this->rLance, $this->rGarde, $this->nbLance);

		if(count($this->rGarde) == 3){
			if($this->nbLance == 1){
				//echo '<h2 style="color:red">421 en '.$this->nbLance.' lancé!!</h2>';
				$this->whaou ++;
			} else {
				//echo "<h2>421 en $this->nbLance lancé!!</h2>";
			}
		} else {
			$this->LanceDe($relance);
		}
	}

	private static function AffLance($rLance, $rGarde, $nbLance){
		echo 'Nb Lancé : '.$nbLance.'<br>';
		echo 'Lancé : '.implode('-', $rLance).'<br>';
		echo 'Gardé : '.implode('-', $rGarde).'<br>';
		echo '<hr>';
	}
}
$lol = 0;
for ($i=0; $i < 100000; $i++) {
	$quatreCentVinghtEtUn = new QuatreCentVinghtEtUn();
	$quatreCentVinghtEtUn->LanceDe(3);
	if($quatreCentVinghtEtUn->whaou ==1){
		$lol++;
	}
}
echo ($lol/1000);

