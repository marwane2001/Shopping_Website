<?php

namespace App\Controller;

use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    #[Route('/order/shipping', name: 'app_order')]
    public function index(): Response
    {
        $form = $this->createForm(OrderType::class,null,[
            'addresses'=>$this->getUser()->getAddresses()
        ]);
        return $this->render('order/index.html.twig', [
            'deliveryform' => $form->createView(),
        ]);
    }
}
