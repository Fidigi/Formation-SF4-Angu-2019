<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('front/home.html.twig', [
            'site_title' => "Home Page",
        ]);
    }

    /**
     * @Route("/event", name="app_event")
     * @return Response
     */
    public function eventAction()
    {
        $em = $this->get('doctrine')->getManager();
        //var_dump($em);

        $event = new Event();
        $event->setName('Conf. Laravel 3');
        $event->setPrice(18.5);
        $event->setDate(new \Datetime());
        $event->setDescription('desc.');
        $event->setLocalisation('Paris');

        $em->persist($event);
        $em->flush();

        $aEvent = $em->getRepository(Event::class)->recupFL();

        var_dump($aEvent);

        return $this->render('front/home.html.twig', [
            'site_title' => "Home Page",
        ]);
    }
}

