<?php

namespace App\Controller;
use App\Repository\OrderRepository;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{

    #[Route('/order/payment/{id_order}', name: 'app_payment')]
    public function index($id_order,OrderRepository $orderRepository): Response
    {   $order=$orderRepository->findOneById($id_order);

        foreach ($order->getOrderDetails() as $product){
            $product_for_stripe=[

                    'price_data' =>[
                        'currency' => 'eur',
                        'unit_amount' => $product->getPrice(),
                        'product_data' => [
                            'name' => 'Test Product',
                        ]
                    ] ,
                    'quantity' => 1,


            ];
            dd($product);

        }
        $stripeApiKey = $_ENV['STRIPE_API_KEY'];
        Stripe::setApiKey($stripeApiKey);
        $YOUR_DOMAIN = 'http://127.0.0.1:3000';


        $checkout_session = Session::create([
            'line_items' => [[
                'price_data' =>[
                    'currency' => 'eur',
                    'unit_amount' => 10020,
                    'product_data' => [
                        'name' => 'Test Product',
                    ]
                ] ,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);
        header("HTTP/1.1 301 See Other");
        return $this->redirect($checkout_session->url);

    }
}
