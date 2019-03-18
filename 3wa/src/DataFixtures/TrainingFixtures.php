<?php
namespace App\DataFixtures;

use App\Entity\Training;
use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TrainingFixtures extends Fixture
{
    
    public function __construct()
    {
    }
    
    public function load(ObjectManager $manager)
    {
        foreach ($this->getModuleData() as [$name, $alias]) {
            $module = new Module();
            $module->setName($name);
            $module->setAlias($alias);
            
            $manager->persist($module);
            $this->addReference($alias, $module);
        }
        unset($module);
        
        foreach ($this->getTrainingData() as [$name, $modules]) {
            $training = new Training();
            $training->setName($name);
            foreach ($modules as $moduleAlias){
                $training->addModule($this->getReference($moduleAlias));
            }
            
            $manager->persist($training);
        }
        
        $manager->flush();
    }
    
    private function getTrainingData(): array
    {
        return [
            // $trainingData = [$name, $modules];
            ['BackOffice Web Developper',['HTML_CSS', 'PHP', 'MYSQL']],
            ['Front-end Web Developper',['HTML_CSS', 'JAVASCRIPT', 'BOOTSTRAP']],
            ['Web Designer',['HTML_CSS', 'PHOTOSHOP', 'ILLUSTRATOR', 'BOOTSTRAP']],
        ];
    }
    
    private function getModuleData(): array
    {
        return [
            // $moduleData = [$name, $alias];
            ['HTML CSS', 'HTML_CSS'],
            ['PHP', 'PHP'],
            ['JavaScript', 'JAVASCRIPT'],
            ['Photoshop', 'PHOTOSHOP'],
            ['Illustrator', 'ILLUSTRATOR'],
            ['MySQL', 'MYSQL'],
            ['Bootstrap', 'BOOTSTRAP'],
        ];
    }
}