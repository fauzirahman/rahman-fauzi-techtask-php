<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipe", name="recipe")
     */
    public function indexAction()
    {
        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
    }


    public function list()
    {
        
        $recipes = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAllRecipeHaveIngredients();

        
        
        return $this->json(['data'=>$recipes]);      
    }
}
