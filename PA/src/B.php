<?php
namespace App;

class B
{
	private $say;

	public function __construct(){
		$this->say = 'je suis la classe B'.'<br>';
		echo $this->getSay();
	}

	public function getSay(){
		return $this->say;
	}
}