<?php
interface IProduct
{
    public function getDescription();
    public function getPrice();
}

abstract class Product implements IProduct
{
    protected $description;
    protected $price;

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

class Pancake extends Product
{
    public function __construct()
    {
        $this->description = 'un pancake';
        $this->price       = 2.50;
    }
}

class Waffle extends Product
{
    public function __construct()
    {
        $this->description = 'une gauffre';
        $this->price       = 4.0;
    }
}

abstract class ProductDecorator implements IProduct
{
    protected $product;

    public function __construct(IProduct $product)
    {
        $this->product = $product;
    }

}

class Chocolat extends ProductDecorator
{
    public function getDescription() {
        return $this->product->getDescription()." + Chocolat";
    }

    public function getPrice() {
        return 0.70 + $this->product->getPrice();
    }
}

class Chantilly extends ProductDecorator
{
    public function getDescription() {
        return $this->product->getDescription()." + Chantilly";
    }

    public function getPrice() {
        return 0.50 + $this->product->getPrice();
    }
}

class Caramel extends ProductDecorator
{
    public function getDescription() {
        return $this->product->getDescription()." + Caramel";
    }

    public function getPrice() {
        return 0.40 + $this->product->getPrice();
    }
}