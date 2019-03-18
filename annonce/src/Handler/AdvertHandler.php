<?php
namespace App\Handler;

use App\Entity\Advert;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdvertHandler
{
    
    /**
     * @var ObjectManager
     */
    private $objectManager;
    
    
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;
    
    /**
     * @param ObjectManager $objectManager
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(ObjectManager $objectManager,LoggerInterface $loggerInterface)
    {
        $this->objectManager = $objectManager;
        $this->loggerInterface = $loggerInterface;
    }
    
    /**
     * @param FormInterface $form
     * @param Request $request
     * @return boolean
     */
    public function handle(FormInterface $form,Request $request)
    {
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $advert = $form->getData();
            
            try {
                $this->objectManager->persist($advert);
            } catch (ORMException $e) {
                $this->loggerInterface->error($e->getMessage());
                $form->addError(new FormError("Erreur lors de l'insertion en base d'un Advert"));
                return false;
            }
            
            $this->objectManager->flush();
            
            return true;
        }
        
        return false;
    }
}

