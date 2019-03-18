<?php

//echo sha1('Mast€rKeYPriv@te__test');

class BrutForce
{
	private $char;
	private $prefix;
	private $limitChar;
	private $mdpToRetrieve;
	private $tabChar;

	public function __construct($limitChar, array $mdpToRetrieve, $prefix){
		$this->char = range(33,125);
		$this->combine = count($this->char);
		$this->limitChar = $limitChar;
		$this->prefix = $prefix;
		$this->mdpToRetrieve = $mdpToRetrieve;
	}

	public function run(){
		$nbCharTest = 1;
		while ($nbCharTest <= $this->limitChar) {
			$this->preProcess($nbCharTest);
			if($this->process($nbCharTest) === false){
				echo '<br>+1 carc<br>&nbsp;<br>';
				var_dump($this);
				$nbCharTest++;
			}
		}
	}

	private function preProcess($nbCharTest){
		for ($i=1; $i <= $nbCharTest; $i++) { 
			$tabChar[$i]['v'] = $this->char[0];
			$tabChar[$i]['k'] = 0;
		}
		$this->tabChar = $tabChar;
	}


	private function process($nbCharTest){
		for ($i=0; $i <= $this->combine - 1 ; $i++) {
			if($this->test()){
				return true;
			}
			if($this->incChar($nbCharTest) == true && $nbCharTest > 1){
				$this->incChar($nbCharTest - 1);
				$i = 0;
			}
		}
		return false;
	}

	private function incChar($nb){
		$boucle = false;
		if($this->tabChar[$nb]['v'] == $this->char[$this->combine - 1]){
			$this->tabChar[$nb]['v'] = $this->char[0];
			$boucle = true;
			if($nb > 1){
				$this->incChar($nb - 1);
			}
		} else {
			$this->tabChar[$nb]['v'] = $this->char[++ $this->tabChar[$nb]['k']];
		}
		return $boucle;
	}

	private function test(){
		$text = '';
		foreach ($this->tabChar as $value) {
			$text .= chr($value['v']);
		}
		$return = sha1($this->prefix.$text).' => '.$text;
		$find = false;
		if (in_array(sha1($this->prefix.$text), $this->mdpToRetrieve)){
			$return .= ' GOOD!!';
			$find = true;
		}
		echo $return.'<br>';
		return $find;
	}
}

$mdpToRetrieve = [
		'9e66b0af59d51e51a5ea9cd3132f277cbc642eaa',
		'24749492142798c83404cb78f2e58941f8264b31',
		'3e810f7223c44b31a9767ddffff5d23fa7ae1e3b',
		'434776c39a9cea654090e5e7435cedd0c2911176',
		'9f2f6bac189c6744c3f7aacf41a70d986ba35b38',
		'690e7743350b9cbdab5516dd55730616afed42d9',
		'65d74c2cb35a3dd6c27fbd66a270ba27d91c0410',
		'2e179b9a67acb360566409604efaf30669b4718c',
		'e0fdf181ac4ee847cb312bfd815c0a0759be3a95'
		];

$prefix = 'Mast€rKeYPriv@te__';
$limitChar = 2;

$bf = new BrutForce($limitChar,$mdpToRetrieve,$prefix);
$bf->run();