<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Training;
use App\Entity\Module;

class ModuleController extends AbstractController
{
    /**
     * @Route("/module/{id}", name="app_module_view")
     */
    public function indexAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $aTraining = $em->getRepository(Training::class)->findAll();
        $module = $em->getRepository(Module::class)->find($id);

        return $this->render('front/module.html.twig', [
            'trainings' => $aTraining,
            'module' => $module,
        ]);
    }
}
