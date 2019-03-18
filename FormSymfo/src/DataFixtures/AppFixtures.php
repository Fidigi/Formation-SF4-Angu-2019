<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\Event;

class AppFixtures extends Fixture
{
	private $faker;

    public function load(ObjectManager $manager)
    {
    	$this->faker = Faker\Factory::create();
    	$this->addFaker($manager);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    private function addFaker(ObjectManager $manager)
    {
    	for ($i=0; $i <= 30; $i++) { 
    		$event = new Event();
    		$event->setName($this->faker->name);
	        $event->setPrice(18.5);
	        $event->setDate($this->faker->dateTime);
	        $event->setDescription('desc.');
	        $event->setLocalisation('Paris');
    		$manager->persist($event);
    	}
    }
}
