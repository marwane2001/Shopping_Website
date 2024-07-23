<?php

namespace App\Class;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart {
    public function __construct(private RequestStack $requestStack) {}

    public function add($product) {
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', []); // Initialize cart as an empty array if it is null

        if (isset($cart[$product->getId()])) {
            $cart[$product->getId()] = [
                'object' => $product,
                'qty' => $cart[$product->getId()]['qty'] + 1,
            ];
        } else {
            $cart[$product->getId()] = [
                'object' => $product,
                'qty' => 1,
            ];
        }

        $session->set('cart', $cart);
    }

    public function getCart() {
        return $this->requestStack->getSession()->get('cart');
    }
}
