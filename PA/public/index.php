<?php

require '../vendor/autoload.php';

//include 'test.php';
include 'observer.php';

if(isset($_POST['firstname'])){
	var_dump($_POST);
}

use App\Controller\Personne;

$p = new Personne();
Personne::Factory($p, $_POST);

var_dump($p);