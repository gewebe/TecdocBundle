<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc301SearchTree;
use Doctrine\ORM\EntityRepository;

/**
 * Entity repository for SearchTree
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class SearchTreeRepository extends EntityRepository
{
    /**
     * Get search tree by id
     * @param int $treetypenr
     * @return Tecdoc301SearchTree[]
     */
    public function getTree(int $treetypenr): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['searchtree'])
          ->from(Tecdoc301SearchTree::class, 'searchtree')
          ->where('searchtree.treetypenr = :treetypenr')
          ->andWhere('searchtree.nodeparentId IS NULL')
          ->orderBy('searchtree.sortnr')
          ->setParameter(':treetypenr', $treetypenr);

        return $qb->getQuery()->getResult();
    }
}
