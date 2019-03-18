<?php
interface IMakeSound {
    public function makeSound();
}

interface IFly {
    public function fly();
}

abstract class Bird implements IMakeSound
{
    protected $sound;

    public function makeSound() {
        if($this->sound != null) echo "<h2>".$this->sound."</h2>";
    }
}

class Duck extends Bird  implements IFly
{
    public function __construct() {
        $this->sound = "Coin Coin naturel !";
    }

    public function fly()
    {
        echo "<h2>I believe I can fly !</h2>";
    }
}


class Ostrich extends Bird
{
    public function __construct() {
        $this->sound = "Bruh !";
    }
}

class Auk extends Bird
{
    public function __construct() {
        $this->sound = "Beurp !";
    }
}


class BathDuck implements IMakeSound
{
    protected $sound;
    private $hasBattery;


    public function __construct($battery = null)
    {
        $this->giveBattery($battery);
        $this->sound = "Coin Coin pas naturel !";
    }

    public function giveBattery($battery)
    {
        if($battery !== null)
        {
            $this->hasBattery = true;
        }
    }

    public function makeSound()
    {
        if($this->hasBattery == true)
        {
            echo "<h2>".$this->sound."</h2>";
        }
    }
}




// (...) EXEMPLE DE CODE CLIENT

$birds = [ new Duck(), new Auk(), new Ostrich(), new BathDuck(), new BathDuck(true) ];

foreach($birds as $bird)
{
    echo '<h1>Nouvel oiseau : '.get_class($bird).'</h1>';

    try
    {
        if($bird instanceof IMakeSound)
        {
            $bird->makeSound();
        }
        if($bird instanceof IFly)
        {
            $bird->fly();
        }
    }
    catch(Exception $exception)
    {
        echo '<h2>ERREUR : '.$exception->getMessage().'</h2>';
    }
}