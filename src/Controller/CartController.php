<?php

namespace App\Controller;

use App\Class\Cart;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart/{pattern}', name: 'app_cart', defaults: ['pattern' => null])]
    public function index(Cart $cart, ?string $pattern): Response
    {
        if ($pattern === "cancel") {
            $this->addFlash(
                'info',
                'Payment Canceled: You can update your Cart and Order'
            );
        }

        return $this->render('cart/cart.html.twig', [
            'cart' => $cart->getCart(),
            'totalWt' => $cart->getTotalWt(),
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(int $id, Cart $cart, ProductRepository $productRepository, Request $request): Response
    {
        $product = $productRepository->find($id);
        if ($product) {
            $cart->add($product);
            $this->addFlash(
                'success', "Product has been added to cart successfully!"
            );
        } else {
            $this->addFlash(
                'error', "Product not found!"
            );
        }

        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/cart/decrease/{id}', name: 'app_cart_decrease')]
    public function decrease(int $id, Cart $cart): Response
    {
        $cart->decrease($id);
        $this->addFlash(
            'success', "Product has been removed from the cart successfully!"
        );

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove', name: 'app_cart_remove')]
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        $this->addFlash(
            'success', "The cart has been cleared successfully!"
        );

        return $this->redirectToRoute('app_cart_remove');
    }

}
