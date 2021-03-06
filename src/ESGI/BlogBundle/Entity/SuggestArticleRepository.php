<?php

namespace ESGI\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * SuggestArticleRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SuggestArticleRepository extends EntityRepository
{
    public function getArticlesPaginator($numberByPage, $page)
    {
        if ($page < 1) {
            throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "'.$page.'").');
        }
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.title', 'DESC')
            ->getQuery();

        // On définit le contenu à partir duquel commencer la liste
        $query->setFirstResult(($page-1) * $numberByPage)
            // Ainsi que le nombre de contenus à afficher
            ->setMaxResults($numberByPage);

        return new Paginator($query);
    }
}
