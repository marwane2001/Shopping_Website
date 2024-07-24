<?php

namespace App\Controller;
use App\Entity\Adress;
use App\Form\AddressUserType;
use App\Form\PasswordUserType;
use App\Repository\AdressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/compte.html.twig',
        );
    }

    #[Route('/compte/modifier-mdp', name: 'app_account_modify_pwd')]
    public function password(Request $request,UserPasswordHasherInterface $passwordHasher): Response

    {

        $user = $this->getUser();
        $form = $this->createForm(PasswordUserType::class,$user ,[
            'passwordHasher'=>$passwordHasher
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash(
                'success',"votre mot de passe est correctement mis a jour"
            );
        }
        return $this->render('account/resetpwd.html.twig',[
            'modifypwd'=>$form->createView(),
            ]
        );
    }

    #[Route('/compte/addresses', name: 'app_account_addresses')]
    public function addresses(): Response
    {
        return $this->render('account/addresses.html.twig',
        );
    }

    #[Route('/compte/address/add/{id}', name: 'app_account_address_form',defaults: ['id'=>null])]
    public function addressForm(Request $request,$id,AdressRepository $adressRepository): Response
    {
        if ($id) {
                $address=$adressRepository->findOneById($id);
                if(!$address OR $address->getUser()!=$this->getUser()){
                        return $this->redirectToRoute('app_account_address_form');
                }
        }
        else{
            $address=new Adress();
            $address->setUser($this->getUser());
        }


        $form= $this->createForm( AddressUserType::class,$address);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($address);
            $this->entityManager->flush();
            $this->addFlash(
                'success',
                'Your address has been saved,Successfully!'
            );
            return $this->redirectToRoute('app_account_addresses');
        }
        return $this->render('account/address.html.twig',
        [
            'addressform'=>$form
        ]
        );
    }

    #[Route('/compte/addresses/delete/{id}', name: 'app_account_addresses_delete')]
    public function addressDelete($id,AdressRepository $adressRepository): Response
    {
       $address=$adressRepository->findOneById($id);
       if(!$address OR $address->getUser()!=$this->getUser()){
           return $this->redirectToRoute('app_account_address_form');
       }
        $this->addFlash(
            'success',
            'Your address has been Deleted,Successfully!'
        );
       $this->entityManager->remove($address);
       $this->entityManager->flush();
return $this->redirectToRoute('app_account_addresses');
    }
}
