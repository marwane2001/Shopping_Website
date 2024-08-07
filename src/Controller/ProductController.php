<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{slug}', name: 'app_product')]
    public function index($slug,ProductRepository $productRepository ): Response
    {
        $product=$productRepository->findOneBySlug($slug);
        if (!$product) {
            return $this->redirectToRoute('/');
        }

        return $this->render('product/product.html.twig', [
            'product' => $product,
        ]);
    }
}
