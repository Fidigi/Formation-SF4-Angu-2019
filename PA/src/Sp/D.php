<?php
namespace App\Sp;

class D
{
	private $say;

	public function __construct(){
		$this->say = 'je suis la classe D'.'<br>';
		echo $this->getSay();
	}

	public function getSay(){
		return $this->say;
	}
}