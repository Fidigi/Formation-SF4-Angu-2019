<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PierreController extends AbstractController
{
    /**
     * @Route("/pierre", name="pierre")
     * @return Response
     */
    public function indexAction()
    {
        $tabAge = ["Pierre" => 10, "Paul" => 28, "Jaques" => 16];

        $tabEvent = [
            [
                'name' => 'Conference Laravel',
                'date' => '20-01-2019 15:00',
                'lieu' => 'Paris'
            ],
            [
                'name' => 'Meetup Symfony',
                'date' => '12-02-2019 09:00',
                'lieu' => 'Canada'
            ],
            [
                'name' => 'Laravel',
                'date' => '20-02-2019 10:00',
                'lieu' => 'Senegal'
            ]
        ];

        return $this->render('front/pierre.html.twig', [
            'tabAge' => $tabAge,
            'tabEvent' => $tabEvent,
        ]);
    }
}

