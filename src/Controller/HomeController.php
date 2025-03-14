<?php

namespace App\Controller;

use App\Entity\Enum\StateEnum;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository
    ): Response {
        $categoryId =  (int) $request->query->get('category', 0);
        
        if ($categoryId === 0) {
            $articles = $articleRepository->findAll();
        } else {
            $articles = $articleRepository->findByCategory($categoryRepository->find($categoryId));
        }

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'categories' => $categoryRepository->findAll(),
            'selectedCategory' => $categoryId,
        ]);
    }
}
