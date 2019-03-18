<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Advert;
use App\Form\AdvertType;
use App\Handler\AdvertHandler;

class DefaultController extends AbstractController
{
    /**
     * @Route(
            "/{page}", 
            name="home",
            defaults={"page": 1},
            requirements={
                "page": "\d*"
            }
        )
     */
    public function index()
    {
        return new Response('home');
    }

    /**
     * @Route(
            "/advert/{id}", 
            name="view",
            requirements={
                "id": "\d+"
            }
        )
     */
    public function view($id)
    {
        return new Response('view');
    }

    /**
     * @Route(
            "/add", 
            name="add"
        )
     */
    public function add(AdvertHandler $handler, Request $request)
    {
        $advert = new Advert();
        $form   = $this->get('form.factory')->create(AdvertType::class, $advert);
        $form = $this->createForm(AdvertType::class, $advert);
        if($handler->handle($form, $request))
        {
            return $this->redirectToRoute('home');
        }

        return $this->render('front/form/add_advert.html.twig', [
          'form' => $form->createView(),
        ]);
        /*
    	$advert = new Advert();
    	$form = $this->createForm(AdvertType::class, $advert);
    	if($handler->handle($form, $request))
    	{
            return $this->redirectToRoute('home');
        }

        return $this->render('front/form/add_advert.html.twig', [
            'form' => $form->createView(),
        ]);
        */
    }

    /**
     * @Route(
            "/edit/{id}", 
            name="edit",
            requirements={
                "id": "\d+"
            }
        )
     */
    public function edit($id)
    {
        return new Response('edit');
    }

    /**
     * @Route(
            "/delete/{id}", 
            name="delete",
            requirements={
                "id": "\d+"
            }
        )
     */
    public function delete($id)
    {
        return new Response('delete');
    }
}

/*
  - Convertissons ces routes en annotations et implémentons les vues correspondantes
  - essayons de créer un bouton pour postuler à une annonce
  
  Routes :

        home:
            path:      /{page}
            defaults:
                _controller: App\Controller\DefaultController::index
                page:        1
            requirements:
                page: \d*

        view:
            path:      /advert/{id}
            defaults:
                _controller: App\Controller\DefaultController::view
            requirements:
                id: \d+

        add:
            path:      /add
            defaults:
                _controller: App\Controller\DefaultController::add

        edit:
            path:      /edit/{id}
            defaults:
                _controller: App\Controller\DefaultController::edit
            requirements:
                id: \d+

        delete:
            path:      /delete/{id}
            defaults:
                _controller: App\Controller\DefaultController::delete
            requirements:
                id: \d+


advert
	date
	tilt7e
	author
	content
	published bool
	image_id

  - Definition d'une relation unidirectionnelle de type OneToOne
  
  /**
    * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    *
  private $image;

image
	url
	alt

application
	author
	content
	date
	private_advert
	
  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Advert")
   * @ORM\JoinColumn(nullable=false)
   *
  private $advert;
  
  
  - Dans le constructeur, on peut charger automatiquement une date :
    exple:
    $this->date  = new \Datetime();
*/