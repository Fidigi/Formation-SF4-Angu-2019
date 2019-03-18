<?php
namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PersonFixtures extends Fixture
{
    private $faker;
        
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i=1; $i <= 30; $i++) { 
            $person = new Person();
            $person->setFirstname($this->faker->firstName);
            $person->setLastname($this->faker->lastName);
            $person->setEmail($this->faker->email);
            $manager->persist($person);
        }

        $manager->flush();
    }
}
