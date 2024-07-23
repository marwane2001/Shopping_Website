<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category')]
    public function index($slug,CategoryRepository $categoryRepository ): Response
    {
        //categoryrepositorty dependency makes a connection with db
        $category = $categoryRepository->findOneBySlug($slug);
        if (!$category) {
            return $this->redirectToRoute('app_error404');
        }

        return $this->render('category/category.html.twig', [
            'category' => $category,
        ]);
    }
}
