<?php

namespace App\Controller;

use App\Entity\Enum\StateEnum;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController{
    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        ArticleRepository $articleRepository,
        CategorieRepository $categorieRepository
    ): Response {
        $categoryId = $request->query->get('category');
        
        $criteria = ['state' => StateEnum::PUBLISHED];
        if ($categoryId) {
            $criteria['categories'] = $categoryId;
        }
        
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findBy($criteria, ['createdAt' => 'DESC']),
            'categories' => $categorieRepository->findAll(),
            'selectedCategory' => $categoryId,
        ]);
    }
}
