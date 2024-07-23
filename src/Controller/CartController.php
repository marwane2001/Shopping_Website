<?php

namespace App\Controller;

use App\Class\Cart;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
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
    public function add($id,Cart $cart,ProductRepository $productRepository,Request $request): Response
    {

        $product = $productRepository->findOneById($id);
        $cart->add($product);
        $this->addFlash(
            'success',"Product has been added to cart successfully!"
        );
        return $this->redirect( $request->headers->get('referer'));



    }

    #[Route('/cart/decrease/{id}', name: 'app_cart_decrease')]
    public function decrease($id,Cart $cart ): Response
    {


        $cart->decrease($id);
        $this->addFlash(
            'success',"Product has Deleted from the cart successfully!"
        );

        return $this->redirectToRoute('app_cart');

    }


    #[Route('/cart/remove', name: 'app_cart_remove')]
    public function remove(Cart $cart): Response
    {


         $cart->remove();
        $this->addFlash(
            'success',"the cart has been cleared successfully!"
        );

        return $this->redirectToRoute('app_home');

    }

}
