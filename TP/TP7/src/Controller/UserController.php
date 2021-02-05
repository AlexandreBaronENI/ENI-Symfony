<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('user/signin.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){}


    /**
     * @Route("/inscription", name="signup")
     */
    public function signup(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $signForm = $this->createForm(SignUpType::class, $user);

        $signForm->handleRequest($request);
        if($signForm->isSubmitted() && $signForm->isValid()){
            $hashpass = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hashpass);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre compte a bien été créé ! Bienvenue !');
            return $this->redirectToRoute('signin');
        }

        return $this->render("user/signup.html.twig", [
            'signForm' => $signForm->createView()
        ]);
    }
}