<?php

namespace ESGI\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{

    public function getArticlesPublished($numberByPage, $page)
    {
        if ($page < 1) {
            throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "'.$page.'").');
        }

        $isPublished = 1;
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.image', 'i')
            ->addSelect('i')
            ->orderBy('a.updated', 'DESC')
            ->where('a.isPublished = :isPublished')
            ->setParameter('isPublished', $isPublished)
            ->getQuery();

        // On définit le contenu à partir duquel commencer la liste
        $query->setFirstResult(($page-1) * $numberByPage)
            // Ainsi que le nombre de contenus à afficher
            ->setMaxResults($numberByPage);

        return new Paginator($query);
    }
}