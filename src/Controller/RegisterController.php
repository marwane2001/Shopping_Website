<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $user= new User();
        $form = $this->createForm(RegisterUserType::class,$user);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash(
                'success',"You have created your account successfully!"
            );
            return $this->redirectToRoute('app_login');
        }
        return $this->render('register/inscription.html.twig',[
            'RegisterForm'=>$form->createView()

        ]);
    }
}
