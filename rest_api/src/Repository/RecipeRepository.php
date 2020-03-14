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
        $stmt = $conn->prepare($sql);       
        $stmt->execute();

        
        $arr = array();
        
         foreach ($stmt->fetchAll() as $key => $value) {
           
            foreach (unserialize($value['ingredients']) as $k => $val) {
                 
                $sql2 = 'SELECT * FROM ingredient p
                    WHERE DATE(p.use_by) > CURRENT_DATE
                    AND p.title like "%'.$val.'%"
                    ORDER BY p.best_before_date DESC
                ';
                
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();
                if(empty($stmt2->fetchAll())){ 
                    $exc_recipe = $value['title'];                   
                }
               
            }
           if($exc_recipe !== $value['title']){
               $format_data = array(
                   'title'=>$value['title'],
                   'ingredients'=>unserialize($value['ingredients'])
                );
                array_push($arr,$format_data);
           }
            
        }
       
               
        // returns an array of arrays (i.e. a raw data set)
        return $arr;

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
