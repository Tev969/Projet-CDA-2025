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
        $categoryId = $request->query->getInt('category');

        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findByCategory($categoryRepository->find($categoryId)),
            'categories' => $categoryRepository->findAll(),
            'selectedCategory' => $categoryId,
        ]);
    }
}
