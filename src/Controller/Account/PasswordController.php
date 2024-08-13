<?php

namespace App\Controller\Account;


use App\Form\PasswordUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


class PasswordController extends AbstractController{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/account/change-password', name: 'app_account_modify_pwd')]
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher): Response

    {

        $user = $this->getUser();
        $form = $this->createForm(PasswordUserType::class,$user ,[
            'passwordHasher'=>$passwordHasher
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash(
                'success',"Your Password Has Been Changed,Successfully"
            );
        }
        return $this->render('account/password/index.html.twig',[
                'modifypwd'=>$form->createView(),
            ]
        );
    }

}
?>