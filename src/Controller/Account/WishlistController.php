<?php

namespace App\Controller\Account;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishlistController extends AbstractController
{
    #[Route('/account/whishlist', name: 'app_account_wishlist')]
    public function index(): Response
    {
        return $this->render('account/wishlist/index.html.twig');
    }

    #[Route('/account/wishlist/add/{id}', name: 'app_account_wishlist_add')]
    public function add(ProductRepository $productRepository, EntityManagerInterface $entityManager, Request $request, $id): Response
    {

        $product = $productRepository->findOneById($id);


        if ($product) {
            $this->getUser()->addWishlist($product);

            $entityManager->flush();
        }

        $this->addFlash(
            'success',
            "Product has been added successfully to your wishlist."
        );

        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/account/wishlist/remove/{id}', name: 'app_account_wishlist_remove')]
    public function remove(ProductRepository $productRepository, EntityManagerInterface $entityManager, Request $request, $id): Response
    {
        $product = $productRepository->findOneById($id);

        if ($product) {
            $this->addFlash('success', 'Product has been removed successfully to your wishlist.');

            $this->getUser()->removeWishlist($product);
            $entityManager->flush();
        } else {
            $this->addFlash('danger', 'Product not found.');
        }

        return $this->redirect($request->headers->get('referer'));
    }
}
