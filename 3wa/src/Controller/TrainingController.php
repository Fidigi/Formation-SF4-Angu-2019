<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Training;

class TrainingController extends AbstractController
{
    /**
     * @Route("/training", name="app_training_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getManager();
        $aTraining = $em->getRepository(Training::class)->findAll();

        return $this->render('front/home.html.twig', [
            'trainings' => $aTraining,
        ]);
    }

    /**
     * @Route("/training/{id}", name="app_training_view")
     */
    public function viewAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $aTraining = $em->getRepository(Training::class)->findAll();
        $training = $em->getRepository(Training::class)->find($id);

        return $this->render('front/training.html.twig', [
            'trainings' => $aTraining,
            'training' => $training,
        ]);
    }
}
