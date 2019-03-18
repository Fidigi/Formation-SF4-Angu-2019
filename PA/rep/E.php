<?php

class E
{
	private $say;

	public function __construct(){
		$this->say = 'je suis la classe E'.'<br>';
		echo $this->getSay();
	}

	public function getSay(){
		return $this->say;
	}
}