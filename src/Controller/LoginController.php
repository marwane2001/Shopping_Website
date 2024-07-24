<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error=$authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'controller_name' => 'LoginController',
            'error'=>$error,
            'last_username' => $lastUsername,
        ]);
    }
    #[Route('/deconnexion', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        // controller can be blank: it will never be called!
        throw new \Exception(message: 'Don\'t forget to activate logout in security.yaml');
    }
}

