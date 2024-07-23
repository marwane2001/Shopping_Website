<?php

namespace App\Controller;

use App\Class\Cart;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(Cart $cart): Response
    {

        return $this->render('cart/cart.html.twig', [
            'cart' => $cart->getCart()

        ]);
    }


    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add($id,Cart $cart,ProductRepository $productRepository): Response
    {
        $product = $productRepository->findOneById($id);
        $cart->add($product);
        $this->addFlash(
            'success',"Product has been added to cart successfully!"
        );
        return $this->redirectToRoute('app_product',[
            'slug' => $product->getSlug(),
        ]);


    }
}
