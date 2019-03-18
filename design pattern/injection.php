<?php
/*
Design Pattern Injection de dependances


interface ICapsule getCodeBarre();

classes CapsuleCappucino, CapsuleChocolat, CapsuleMilk, etc (différentes capsules)



classe MachineTassimo 
attributs :   - $on (si la cafetiere est allumée ou non)
 			  - $reader (le lecteur de code barre)
    		  -	$capsule (la capsule en cours)
methodes : __construct (initialisation de la machine)
			onOff		(démarrage électrique de la machine)
            start		(démarrage (si possible pour faire une boisson)
            addCapsule	(ajout d'une capsule dans la machine)



classe Reader (le lecteur de code barre)

methode : readCodeBarre (la methode de lecture du code barre)
*/

//----- Capsules

interface ICapsule {public function getCodeBarre();}

abstract class ACapsule implements ICapsule
{
	public $codeBarre;

	public function __construct($codeBarre){
		$this->codeBarre = $codeBarre;
	}

	public function getCodeBarre(){
		return $this->codeBarre;
	}
}

class CapsuleCappucino extends ACapsule
{
}

class  CapsuleChocolat extends ACapsule
{
}

class CapsuleMilk extends ACapsule
{
}

//----- Machine

class MachineTassimo
{
	public $on = false;
	public $reader;
	public $capsule;

	public function __construct(){
		$this->reader = new Reader();
	}

	public function onOff(){
		$this->on = ($this->on === true) ? false : true;
		return $this;
	}

	public function start(){
		if($this->on){echo '<h2 style="color:red">Y a pas d\'eau du c...</h2>';}
		else{echo '<h2 style="color:white">faut allumer ^^</h2>';}
	}

	public function addCapsule(ICapsule $capsule){
		$this->capsule = $capsule;
		return $this;
	}
}

class Reader
{
	public function readCodeBarre(ICapsule $capsule){
		echo $capsule->getCodeBarre();
	}
}

$machine = new MachineTassimo();
$machine->onOff();
//$machine->onOff();
$machine->start();