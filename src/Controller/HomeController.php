<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        RecipeRepository $recipeRepository,
        CategoryRepository $categoryRepository,
        Request $request
    ): Response {
        // Numéro de page (1 par défaut)
        $page = max(1, $request->query->getInt('page', 1));
        $limit = 9; // Nombre de recettes affichées par page

        $categoryId = $request->query->get('category');
        $searchTerm = $request->query->get('search');

        // Récupération des recettes paginées et filtrées
        $paginator = $recipeRepository->findPaginated($page, $limit, $searchTerm, $categoryId);
        
        $totalItems = count($paginator);
        $maxPages = (int) ceil($totalItems / $limit);

        // ➕ NOUVEAU : Récupération du Top 3 des recettes les plus vues
        $topRecipes = $recipeRepository->findTopViewed(3);

        return $this->render('home/index.html.twig', [
            'recipes' => $paginator,
            'topRecipes' => $topRecipes,
            'categories' => $categoryRepository->findAll(),
            'currentCategory' => $categoryId,
            'searchTerm' => $searchTerm,
            'currentPage' => $page,
            'maxPages' => $maxPages,
        ]);
    }
}