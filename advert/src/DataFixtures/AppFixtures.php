<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends BaseFixture
{
	/*private static $articleTitles = [
        'Why Asteroids Taste Like Bacon',
        'Life on Planet Mercury: Tan, Relaxing and Fabulous',
        'Light Speed Travel: Fountain of Youth or Fallacy',
    ];*/

	public function loadData(ObjectManager $manager)
    {
        /*$this->createMany(
        	Article::class, 
        	10, 
        	function(Article $article, $count)
        	{
				$article->setTitle($this->faker->randomElement(self::$articleTitles));
        	}
        );*/

        $manager->flush();
    }
}
