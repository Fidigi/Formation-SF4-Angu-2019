<?php
namespace App;

class A
{
	private $say;

	public function __construct(){
		$this->say = 'je suis la classe A'.'<br>';
		echo $this->getSay();
	}

	public function getSay(){
		return $this->say;
	}
}