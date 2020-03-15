<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findAllRecipeHaveIngredients()
    {
       $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM recipe';
        $recipes = $conn->prepare($sql);       
        $recipes->execute();
        
        $data_recipe = array();
        /** Loop data recipe */
        foreach ($recipes->fetchAll() as $key => $value) {
           
            foreach (unserialize($value['ingredients']) as $k => $val) {
                /** select data ingredient */ 
                $sql_ing = 'SELECT * FROM ingredient p
                    WHERE DATE(p.use_by) >= CURRENT_DATE
                    AND p.title like "%'.$val.'%"
                    ORDER BY p.best_before DESC
                ';
                
                $result = $conn->prepare($sql_ing);
                $result->execute();

                /** exclude data recipe where ingredient is null or expired */ 
                if(empty($result->fetchAll())){ 
                    $exc_recipe = $value['title'];                   
                }
               
            }
            
            /** filter data valid recipe */ 
           if($exc_recipe !== $value['title']){

               /** array data json recipe*/
               $format_data = array(
                   'title'=>$value['title'],
                   'ingredients'=>unserialize($value['ingredients'])
                );
                array_push($data_recipe,$format_data);
           }
            
        }
       
             
        // returns an array of arrays (i.e. a raw data set)
        return $data_recipe;

    }


    public function RecipesSortByBestUse($recipes)
    {
       $conn = $this->getEntityManager()->getConnection();

        
        $data_recipe = array();
        /** Loop data recipe */
        foreach ($recipes as $key => $value) {  
            /** Array to String */
            $list = "'". implode("', '", $value['ingredients']) ."'";            
                                    
            $sql_ing = 'SELECT * FROM ingredient p
                WHERE DATE(p.use_by) > CURRENT_DATE
                AND p.title IN ('.$list.')
                ORDER BY p.best_before DESC
            ';
            
            $data_ing = $conn->prepare($sql_ing);
            $data_ing->execute();
             /** Loop data ingredients */
            foreach ($data_ing->fetchAll() as $key_ing => $val_ing) {
                $data[$value['title']][] = $val_ing['title'];
                $last_best_before = $val_ing['best_before'];                               
            }
                            
            $format_data = array(                        
                'recipe'            => $value['title'],
                'ingredients'       => $data[$value['title']],
                'last_best_before'  => $last_best_before
            );

            /** array data recipe and ingredients */
            array_push($data_recipe,$format_data);           
            
        }
        
        $data_recipes = array_column($data_recipe, 'last_best_before');
		array_multisort($data_recipes, SORT_DESC, $data_recipe);	
        
        // returns an array of arrays (i.e. a raw data set)
        return $data_recipe;

    }
    


    // /**
    //  * @return Recipe[] Returns an array of Recipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recipe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function toArray()
{
    return [
        'id' => $this->getId(),
        'title' => $this->getTitle(),
        'ingredients' => $this->getIngredients()        
    ];
}
}
