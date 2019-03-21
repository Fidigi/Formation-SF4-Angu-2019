<?php
namespace App\DataFixtures;

use App\Entity\Movies;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class MovieFixtures extends Fixture
{
    private $faker;
        
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i=0; $i <= 30; $i++) { 
            $person = new Person();
            $person->setName($this->faker->name);
            $manager->persist($person);
        }
        $manager->flush();
        $aPerson = $manager->getRepository(Person::class)->findAll();

        for ($i=0; $i <= 30; $i++) { 
            $movie = new Movies();
            $movie->setName($this->faker->name);
            $movie->setReleaseDate($this->faker->dateTime);
            $movie->setDirector($aPerson[array_rand($aPerson)]);
            $movie->addActor($aPerson[array_rand($aPerson)]);
            $movie->addActor($aPerson[array_rand($aPerson)]);
            $movie->addActor($aPerson[array_rand($aPerson)]);
            $manager->persist($movie);
        }

        $manager->flush();
    }
}
