<?php

namespace App\Controller\Account;
use App\Class\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {

        $mail=new mail();
        $mail=send('mubairekmarwane@gmail.com', 'Marwane', 'Greetings! Your order has been canceled', 'We canceled your order Your order for security Reasons check out the link below to understand more about the issue: http://... ') ;


        return $this->render('account/account.html.twig',
        );
    }



}
