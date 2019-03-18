<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController
{
    
    /**
     * @Route(
            "/forum/{annee}/{mois}/{id}/{slug}.{_format}", 
            name="forum",
            defaults={"_format": "html"},
            requirements={
                "annee": "\d{4}",
                "_format": "html|json|php",
                "mois": "\d{2}",
                "id": "\d+",
                "slug": "[a-zA-Z-]+"
            }
        )
     */
    public function indexAction($annee, $mois, $id, $slug, $_format)
    {
        //var_dump(func_get_args());

        return $this->render('front/bonjour.html.twig', [
            'prenom' => $annee,
            'nom' => $mois,
            'age' => $id
        ]);
    }
}

