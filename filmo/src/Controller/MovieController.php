<?php
namespace App\Controller;

use App\Entity\Movies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name="app_movie")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getManager();
        $aMovies = $em->getRepository(Movies::class)->findAll();

        return $this->render('front/movie_list.html.twig', [
            'H1_title' => "Liste Films",
            'movies' => $aMovies
        ]);
    }

    /**
     * @Route("/movie/view/{id}", name="app_movie_view")
     */
    public function viewAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $movie = $em->getRepository(Movies::class)->find($id);

        return $this->render('front/movie_view.html.twig', [
            'H1_title' => "Film : ".$movie->getName(),
            'movie' => $movie
        ]);

        return json_encode($movie);
    }

    /**
     * @Route("/movie/api/view/{id}", name="app_movie_view_id")
     */
    public function apiViewAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $movie = $em->getRepository(Movies::class)->find(10);

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($movie, 'json');
        //dd($reports);
        
        $response = new JsonResponse($reports);
        return $response;
        
    }
}

