<?php
interface IReader{public function getReaderName();}

class ReaderFactory
{
	public static function factoryReader($name){
        if (class_exists('Reader'.strtoupper($name))) {
        	$className = 'Reader'.strtoupper($name);
            return new $className;
        } else {
        	echo "Support inconnu !";
        }
	}
}
class ReaderCD implements IReader
{
	public function getReaderName(){
		return 'ReaderCD';
	}
}

class ReaderDVD implements IReader
{
	public function getReaderName(){
		return 'ReaderDVD';
	}
}

class ReaderBR implements IReader
{
	public function getReaderName(){
		return 'ReaderBR';
	}
}

interface ISupport {public function getSupportType();}

abstract class ASupport implements ISupport
{
	private $name;

	public function __construct($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}
}

class CD extends ASupport
{
	public function getSupportType(){
		return 'CD';
	}
}

class DVD extends ASupport
{
	public function getSupportType(){
		return 'DVD';
	}
}

class BR extends ASupport
{
	public function getSupportType(){
		return 'BR';
	}
}

class SUPI extends ASupport
{
	public function getSupportType(){
		return 'SUPI';
	}
}

class Player {
	private $support;
	private $reader;

	public function addSupport(ISupport $support){
		$this->support = $support;
		return $this;
	}

	public function play(){
		if($this->support !== null){
			$this->reader = ReaderFactory::factoryReader($this->support->getSupportType());
		} else {
			echo 'Faut mettre un truc dans le lecteur';
		}
		
	}

	public function showDetail(){
		echo "je joue ".$this->support->getName()." avec ".$this->reader->getReaderName();
	}
}

$cd = new CD('Vivaldi');
$dvd = new DVD('Starmania');
$br = new BR('Avatar');

$player = new Player();
$player->play();
echo '<hr>';
$player->addSupport($cd);
$player->play();
$player->showDetail();
echo '<hr>';
$player->addSupport($dvd);
$player->play();
$player->showDetail();
echo '<hr>';
$player->addSupport($br);
$player->play();
$player->showDetail();
echo '<hr>';
$player->addSupport(new SUPI('toto'));
$player->play();
