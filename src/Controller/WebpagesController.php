<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WebpagesController extends AbstractController
{
    #[Route('/webpages/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('webpages/about.html.twig');
    }
    #[Route('/webpages/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('webpages/contact.html.twig');
    }

}
