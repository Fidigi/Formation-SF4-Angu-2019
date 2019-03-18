<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function indexAction()
    {
        /*return $this->render('front/home.html.twig', [
            'site_title' => "Home Page",
        ]);*/


        return new Response('<html><body>Home page!</body></html>');
    }
    
    /**
     * @Route("/admin", name="app_admin")
     * @return Response
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
    
    /**
     * @Route("/back", name="app_back")
     * @return Response
     */
    public function backAction()
    {
        return new Response('<html><body>back page!</body></html>');
    }
}

