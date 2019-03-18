<?php

interface IColor
{
    public function setColor($color);
}

interface IPreview
{
    public function setPreviewPages($pdf);
}

interface IPrice
{
    public function setPrice($price);
}

interface IPromotion extends IPrice
{
    public function applyDiscount($discount);
    public function applyPromotionalCode($code);
}

abstract class Literature implements IPrice, IPreview
{
    protected $pdf;

    protected $price;

    public function setPreviewPages($pdf)
    {
        $this->pdf = $pdf;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}

abstract class Clothe implements IPromotion, IColor
{
    protected $code;

    protected $color;

    protected $discount;

    protected $price;


    public function applyDiscount($discount)
    {
        $this->discount = $discount;
    }

    public function applyPromotionalCode($code)
    {
        $this->code = $code;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}

class Book extends Literature
{
}

class Comics extends Literature
{
}

class TShirt extends Clothe
{
}

class Pant extends Clothe
{
}

class Bike implements IPromotion, IColor
{
    private $code;

    private $color;

    private $discount;

    private $price;


    public function applyDiscount($discount)
    {
        $this->discount = $discount;
    }

    public function applyPromotionalCode($code)
    {
        $this->code = $code;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}

// (...) EXEMPLE DE CODE CLIENT

$items = [ new Book(), new Comics(), new TShirt(), new Pant(),new Bike() ];

foreach($items as $item)
{
    echo '<h1>Nouveau produit : '.get_class($item).'</h1>';

    try
    {
        if ($item instanceof IPriceException) $item->applyDiscount(1.6);
        if ($item instanceof IPriceException) $item->applyPromotionalCode('XMAS2017');
        if ($item instanceof IColor) $item->setColor('red');
        if ($item instanceof IPreview) $item->setPreviewPages('/files/preview.pdf');
        if ($item instanceof IPrice) $item->setPrice(18.25);
        echo serialize($item);
    }
    catch(Exception $exception)
    {
        echo '<h2>ERREUR : '.$exception->getMessage().'</h2>';
    }
}