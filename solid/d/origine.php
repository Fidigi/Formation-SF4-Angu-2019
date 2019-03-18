<?php
//----- PRODUCTS

interface IProduct
{
    public function setPrice($price);
    public function getPrice();
}

abstract class Literature implements IProduct
{
   protected $price;

   public function setPrice($price)
   {
       $this->price = $price;
       return $this;
   }

   public function getPrice()
   {
       return $this->price;
   }
}

class Book extends Literature
{
   protected $isbn;
   public function __construct($isbn)
   {
       $this->isbn = $isbn;
   }
}

class Magazine extends Literature
{
}

//----- CUSTOMER
interface ICustomer
{
   public function getOrder();
   public function buy();
}

abstract class ACustomer implements ICustomer
{
   protected $currentOrder;

   public function getOrder()
   {
       // Est-ce que le panier est vide ?
       if($this->currentOrder == null)
       {
           $this->currentOrder = new Order();
       }
       return $this->currentOrder;
   }
}

class VipCustomer extends ACustomer
{
   public function __construct()
   {
      echo '<h2>Je suis un client VIP</h2>';
   }

   public function buy()
   {
       // Est-ce que le panier est vide ?
       if($this->currentOrder == null)
       {
           // Oui, donc aucun achat à faire.
           return false;
       }
       // Procède au paiement de la commande.
       $orderProcessor = New OrderProcessor($this, New FiveMonthsInstalmentPayment);
       $orderProcessor->checkout();
       return true;
   }
}

class BusinessCustomer extends ACustomer
{
   public function __construct()
   {
      echo '<h2>Je suis un client business</h2>';
   }

   public function buy()
   {
       // Est-ce que le panier est vide ?
       if($this->currentOrder == null)
       {
           // Oui, donc aucun achat à faire.
           return false;
       }
       // Procède au paiement de la commande.
       $orderProcessor = New OrderProcessor($this, New BankTransferPayment);
       $orderProcessor->checkout();
       $orderProcessor = New OrderProcessor($this, New ThreeMonthsInstalmentPayment);
       $orderProcessor->checkout();
       return true;
   }
}

class PersonalCustomer extends ACustomer
{
   public function __construct()
   {
      echo '<h2>Je suis un client particulier</h2>';
   }

   public function buy()
   {
       // Est-ce que le panier est vide ?
       if($this->currentOrder == null)
       {
           // Oui, donc aucun achat à faire.
           return false;
       }
       // Procède au paiement de la commande.
       $orderProcessor = New OrderProcessor($this, New CreditCardPayment);
       $orderProcessor->checkout();
       return true;
   }
}

//----- PAYMENT
interface IPayment
{
   public function execute($totalAmount);
}

class BankTransferPayment implements IPayment
{
   public function execute($totalAmount){
     echo '<h2>Virement SEPA de '.$totalAmount.'</h2>';
   }
}

class CreditCardPayment implements IPayment
{
   public function execute($totalAmount){
     echo '<h2>Paiement carte bleue de '.$totalAmount.'</h2>';
   }
}

class ThreeMonthsInstalmentPayment implements IPayment
{
   public function execute($totalAmount){
     echo '<h2>Paiement en 3x de '.$totalAmount.'</h2>';
   }
}

class FiveMonthsInstalmentPayment implements IPayment
{
   public function execute($totalAmount){
     echo '<h2>Paiement en 5x de '.$totalAmount.'</h2>';
   }
}

//----- ORDER

class Order
{
   private $basket;
   public function __construct()
   {
       $this->basket = [];
   }
   public function addProduct(IProduct $product)
   {
       // Ajout du produit spécifié au panier.
       array_push($this->basket, $product);
   }
   public function getTotalAmount()
   {
       if(empty($this->basket) == true)
       {
           return 0;
       }
       else
       {
           // (...) Code calculant le montant total HT du panier.
           return 125.85; // exemple de résultat
       }
   }
   public function removeProduct(IProduct $product)
   {
       // Recherche le produit spécifié dans le panier.
       $index = array_search($product, $this->basket);
       if($index !== false)
       {
           // Suppression du produit spécifié du panier.
           array_splice($this->basket, $index, 1);
           return true;
       }
       return false;
   }
}

class OrderProcessor
{
   private $customer;
   private $paymentClass;

   public function __construct(ICustomer $customer, IPayment $paymentClass){
       $this->customer = $customer;
       $this->paymentClass = $paymentClass;
   }

   public function checkout()
   {
       $totalAmount = $this->customer->getOrder()->getTotalAmount();
       $this->paymentClass->execute($totalAmount);
   }
}

// (...) CODE CLIENT
$customer1 = new PersonalCustomer();
$customer1->getOrder()->addProduct(new Book('123456'));
$customer1->getOrder()->addProduct(new Book('112233'));
$customer1->buy();
echo '<hr>';

$customer2 = new BusinessCustomer();
$customer2->getOrder()->addProduct(new Book('115463'));
$customer2->buy();
echo '<hr>';

$customer3 = new VipCustomer();
$customer3->getOrder()->addProduct(new Book('522341'));
$customer3->buy();
echo '<hr>';