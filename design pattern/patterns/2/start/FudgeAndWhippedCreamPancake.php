<?php

class FudgeAndWhippedCreamPancake
{
    private $description;

    private $price;


    public function __construct()
    {
        $this->description = 'un pancake, supplément caramel, supplément chantilly';
        $this->price       = 2.50 + 0.40 + 0.50;
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