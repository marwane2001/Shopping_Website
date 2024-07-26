<?php

namespace App\Controller;

use App\Form\OrderType;
use App\Class\Cart;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

class OrderController extends AbstractController{
    #[Route('/order/shipping', name: 'app_order')]
    public function index(): Response
    {
        $user=$this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $addresses = $user->getAdresses() ?? [];
        if (count( $addresses)==0){
            return $this->redirectToRoute('app_account_address_form');

        }

        $form = $this->createForm(OrderType::class, null, [
            'addresses' => $addresses,
            'action' => $this->generateUrl('app_order_summary')
        ]);
        return $this->render('order/index.html.twig', [
            'deliveryform' => $form->createView(),
        ]);
    }

    #[Route('/order/summary', name: 'app_order_summary')]
    public function add(Request $request,Cart $cart): Response
    {

        $form=$this->createForm(OrderType::class,null,[
            'addresses' => $this->getUser()->getAdresses(),
        ]);

        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//
//        }

        return $this->render('order/summary.html.twig', [
            'choices'=>$form->getData(),
            'cart'=>$cart->getCart(),
            'totalWt'=>$cart->getTotalWt(),
        ]);
    }
}
