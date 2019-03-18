<meta charset="utf8">
<?php
include 'Product.php';
//include 'Pancake.php';
/*
include 'WhippedCreamPancake.php';
include 'FudgeAndWhippedCreamPancake.php';

include 'Waffle.php';
include 'WhippedCreamWaffle.php';
include 'ChocolateAndWhippedCreamWaffle.php';


$pancake = new Pancake();
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";

$pancake = new WhippedCreamPancake();
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";

$pancake = new FudgeAndWhippedCreamPancake();
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";


$waffle = new Waffle();
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";

$waffle = new WhippedCreamWaffle();
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";

$waffle = new ChocolateAndWhippedCreamWaffle();
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";
*/

$pancake = new Pancake();
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";

$pancake = new Chocolat(new Pancake());
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";

$pancake = new Chantilly(new Chocolat(new Pancake()));
echo "<h3>Je suis ".$pancake->getDescription()."</h3><em>Coût : ".$pancake->getPrice()." €</em>";

$waffle = new Waffle();
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";

$waffle = new Chocolat(new Waffle());
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";

$waffle = new Chantilly(new Chocolat(new Waffle()));
echo "<h3>Je suis ".$waffle->getDescription()."</h3><em>Coût : ".$waffle->getPrice()." €</em>";