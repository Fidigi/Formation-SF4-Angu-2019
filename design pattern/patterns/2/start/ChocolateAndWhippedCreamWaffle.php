<?php

class ChocolateAndWhippedCreamWaffle
{
    private $description;

    private $price;


    public function __construct()
    {
        $this->description = 'une gauffre, supplément chocolat, supplément chantilly';
        $this->price       = 4.00 + 0.70 + 0.50;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }
}