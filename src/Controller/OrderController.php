<?php

namespace App\Controller;

use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

class OrderController extends AbstractController
{


    #[Route('/order/shipping', name: 'app_order')]
    public function index(): Response
    {
        $user=$this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }
        $addresses = $user->getAdresses() ?? []; // Handle null or empty addresses
        $form = $this->createForm(OrderType::class, null, [
            'addresses' => $addresses
        ]);
        return $this->render('order/index.html.twig', [
            'deliveryform' => $form->createView(),
        ]);
    }
}
