<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;
use App\Entity\User;
use App\Form\Security\RegisterType;


class SecurityController extends AbstractController
{
    private $logger;
    private $mailer;

    public function __construct(LoggerInterface $logger, \Swift_Mailer $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

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
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $user->setAccessToken($tokenGenerator->generateToken());
            $manager->persist($user);
            $manager->flush();

            $this->sendSwiftEmail('register', $user);

            return $this->redirectToRoute('security_login');
        }

        
        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/security/activate/{token}", name="security_activate")
     */
    public function activateAction(string $token)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneByAccessToken($token);

        if ($user === null) {
            return $this->redirectToRoute('app_home');
        }
        $user->setIsActive(true);
        $user->setAccessToken(null);
        $entityManager->flush();
        $this->addFlash('success', 'Your account is activate');
        return $this->redirectToRoute('security_login');
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
    public function lostPasswordAction(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        TokenGeneratorInterface $tokenGenerator
    )
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);

            if ($user === null) {
                return $this->redirectToRoute('app_home');
            }

            try{
                $user->setResetToken($tokenGenerator->generateToken());
                $entityManager->flush();
            } catch (\Exception $e) {
                return $this->redirectToRoute('app_home');
            }

            $this->sendSwiftEmail('lost_password', $user);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('security/lost_password.html.twig');
    }

    /**
     * @Route("/security/reset/{token}", name="security_reset_password")
     */
    public function resetPasswordAction(
        Request $request, 
        string $token, 
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);

            if ($user === null) {
                return $this->redirectToRoute('app_home');
            }

            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        } else {
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }

    private function sendSwiftEmail(string $context, User $user)
    {
        $paramEmail=[];

        switch ($context) {
            case 'register':
                $paramEmail['title'] = 'Registration Email';
                $paramEmail['view'] = 'emails/security/registration.html.twig';
                $paramEmail['url'] = $this->generateUrl('security_activate', array('token' => $user->getAccessToken()), UrlGeneratorInterface::ABSOLUTE_URL);
                break;
            case 'lost_password':
                $paramEmail['title'] = 'Lost Password';
                $paramEmail['view'] = 'emails/security/lost_password.html.twig';
                $paramEmail['url'] = $this->generateUrl('security_reset_password', array('token' => $user->getResetToken()), UrlGeneratorInterface::ABSOLUTE_URL);
                break;
            default:
                # code...
                break;
        }

        $message = (new \Swift_Message($paramEmail['title']))
        ->setFrom('fidigi@gmail.com')
        ->setTo($user->getEmail())
        ->setBody(
            $this->renderView(
                $paramEmail['view'],
                [
                    'name' => $user->getDisplayName(),
                    'url' => $paramEmail['url']
                ]
            ),
            'text/html'
        )
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'emails/security/registration.txt.twig',
                ['name' => $name]
            ),
            'text/plain'
        )
        */
        ;
        $this->mailer->send($message);

        $this->logger->info('Mail envoye : '.$context.' / user : '.$user->getDisplayName());
    }
}
