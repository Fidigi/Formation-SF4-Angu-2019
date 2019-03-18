<?php
namespace App;

class C
{
	private $say;

	public function __construct(){
		$this->say = 'je suis la classe C'.'<br>';
		echo $this->getSay();
	}

	public function getSay(){
		return $this->say;
	}
}