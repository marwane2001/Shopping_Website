<?php

namespace App\Controller;

use App\Form\PasswordUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/compte.html.twig',
        );
    }

    #[Route('/compte/modifier-mdp', name: 'app_account_modify_pwd')]
    public function password(Request $request,UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager): Response

    {

        $user = $this->getUser();
        $form = $this->createForm(PasswordUserType::class,$user ,[
            'passwordHasher'=>$passwordHasher
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'success',"votre mot de passe est correctement mis a jour"
            );
        }
        return $this->render('account/resetpwd.html.twig',[
            'modifypwd'=>$form->createView(),
            ]
        );
    }
}
