<?php

namespace App\Controller;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{
    #[Route('/order/payment', name: 'app_payment')]
    public function index(): Response
    {
        Stripe::setApiKey('sk_test_51PhavhDFgY22qD8WNGk1imWFXN6aa7X596TZPs9iY3qcNkw2kGzQYKq28kUYZoe9cr1xQVMh8gysZL3yKNOQQnDC00b90MF0gQ');
        $YOUR_DOMAIN = 'http://127.0.0.1:3000';


        $checkout_session = Session::create([
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => '{{PRICE_ID}}',
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        die('ok');
    }
}
