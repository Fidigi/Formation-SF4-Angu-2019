<?php
namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class MemberFixtures extends Fixture
{
    private $faker;
        
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i=0; $i <= 30; $i++) { 
            $person = new Member();
            $person->setFirstname($this->faker->firstName);
            $person->setLastname($this->faker->lastName);
            $person->setEmail($this->faker->email);
            $person->setPhoto($this->faker->imageUrl(640, 480));
            $manager->persist($person);
        }

        $manager->flush();
    }
}
