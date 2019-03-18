<?php

namespace App\Controller\Security;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\User;
use App\Entity\Token;
use App\Form\Security\RegisterType;
/*
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Psr\Log\LoggerInterface;
*/

class SecurityController extends AbstractController
{
    /**
     * @Route("/security/signup", name="security_register")
     */
    public function registerAction(
        Request $request, 
        ObjectManager $manager,
        UserPasswordEncoderInterface $passwordEncoder,
        TokenGeneratorInterface $tokenGenerator
    )
    {
        $user = new User();
        
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setUuid();
            $user->setIsActive(false);
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            //$user->setAccessToken($tokenGenerator->generateToken());

            $user->setCreatedAt(new \Datetime());
            $user->setUpdatedAt(new \Datetime());
            $manager->persist($user);
            $manager->flush();

            //$this->sendSwiftEmail('register', $user);

            return $this->redirectToRoute('security_login');
        }

        
        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/security/signin", name="security_login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    
    /**
     * @Route("/security/signout", name="security_logout")
     */
    public function logoutAction(){}

    /**
     * @Route("/security/lost", name="security_lost_password")
     */
    public function lostPasswordAction(){}
}
