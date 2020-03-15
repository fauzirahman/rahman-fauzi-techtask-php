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
         /** get data valid recipe */
        $all_recipes = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAllRecipeHaveIngredients();

         /** get data Ingredients sort by ingredient.use_by desc*/
        $data_recipes = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->RecipesSortByBestUse($all_recipes);

       
        
        return $this->json(['data'=>$data_recipes]);      
    }
}
