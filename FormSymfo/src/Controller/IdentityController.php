<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IdentityController extends AbstractController
{
    
    /**
     * @Route("/bonjour/{nom}/{prenom}/{age<\d+>}", name="bonjour")
     * @return Response
     */
    public function indexAction($nom, $prenom, $age)
    {
        return $this->render('front/bonjour.html.twig', [
            'prenom' => $nom,
            'nom' => $prenom,
            'age' => $age
        ]);
    }
}

