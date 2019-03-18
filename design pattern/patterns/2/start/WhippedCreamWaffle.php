<?php

class WhippedCreamWaffle
{
    private $description;

    private $price;


    public function __construct()
    {
        $this->description = 'une gauffre, supplément chantilly';
        $this->price       = 4.00 + 0.50;
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