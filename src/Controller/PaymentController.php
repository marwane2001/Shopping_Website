<?php

namespace App\Controller;
use App\Repository\OrderRepository;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{



    #[Route('/order/payment/{id_order}', name: 'app_payment')]
    public function index($id_order,OrderRepository $orderRepository,EntityManagerInterface $entityManager): Response
    {
        $YOUR_DOMAIN = $_ENV['DOMAIN'];
        $stripeApiKey = $_ENV['STRIPE_API_KEY'];
        Stripe::setApiKey($stripeApiKey);
        $order=$orderRepository->findOneById($id_order);


        if(!$order){
            return $this->redirectToRoute('app_home');
        }



        $product_for_stripe=[];

        foreach ($order->getOrderDetails() as $product){
            $product_for_stripe[]=[

                    'price_data' =>[
                        'currency' => 'eur',
                        'unit_amount' => number_format($product->getProductPriceWt()*100,0,'',''),
                        'product_data' => [
                            'name' => $product->getProduct(),
                            'images' => [
                                $YOUR_DOMAIN.'/upload-dir/'.$product->getProdcutIllustration()
                            ]

                        ]
                    ] ,
                    'quantity' => $product->getProductQuantity(),


            ];


        }

        $product_for_stripe[]=[

            'price_data' =>[
                'currency' => 'eur',
                'unit_amount' => number_format($order->getCarrierPrice()*100,0,'',''),
                'product_data' => [
                    'name' => 'Carrier :'.$order->getCarrier(),
                ]
            ] ,
            'quantity' => 1,


    ];






        $checkout_session = Session::create([
            'customer_email'=>$this->getUser()->getEmail(),
                'line_items' => [[
                    $product_for_stripe
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/order/thanks/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/cart/cancel',
        ]);
        header("HTTP/1.1 301 See Other");
        $order->setStripeSessionId($checkout_session->id);
        $entityManager->flush();


        return $this->redirect($checkout_session->url);

    }

        #[Route('/order/thanks/{stripe_session_id}', name: 'app_payment_success')]
    public function success($stripe_session_id,OrderRepository $orderRepository,EntityManagerInterface $entityManager): Response
    {
        $order=$orderRepository->findOneBy([
            'stripe_session_id'=>$stripe_session_id,
            'user'=>$this->getUser()

        ]);
        if(!$order){
            return $this->redirectToRoute('app_home');
        }
        if ($order->getState()==1){
            $order->setState(2);
            $entityManager->flush();
        }

        return $this->render('payment/success.html.twig', [
            'order'=>$order,

        ]);
    }
}
