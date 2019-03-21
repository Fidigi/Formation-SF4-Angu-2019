<?php
namespace App\Controller;

use App\Entity\Member;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/member", name="app_member")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getManager();
        $aMember = $em->getRepository(Member::class)->findAll();

        return $this->render('front/member_list.html.twig', [
            'H1_title' => "",
            'members' => $aMember
        ]);
    }

    /**
     * @Route("/member/{id}", name="app_member_view")
     */
    public function viewAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $member = $em->getRepository(Member::class)->find($id);

        return $this->render('front/member_view.html.twig', [
            'H1_title' => "",
            'member' => $member
        ]);
    }
}

