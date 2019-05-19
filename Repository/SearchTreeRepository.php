<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc301SearchTree;

/**
 * Entity repository for SearchTree
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class SearchTreeRepository extends TranslateEntityRepository
{
    /**
     * Get search tree by id
     * @param int $treetypenr
     * @return Tecdoc301SearchTree[]
     */
    public function getTree(int $treetypenr): array
    {
        $dql = 'SELECT searchtree, description
                FROM Gweb\TecdocBundle\Entity\Tecdoc301SearchTree searchtree
                JOIN searchtree.description description WITH description.sprachnr = :sprachnr
                WHERE searchtree.treetypenr = :treetypenr
                AND searchtree.nodeparentId IS NULL
                ORDER BY searchtree.sortnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('treetypenr', $treetypenr);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }

    /**
     * Get node with childs by id
     * @param int $nodeId
     * @return Tecdoc301SearchTree|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getNode(int $nodeId): ?Tecdoc301SearchTree
    {
        $dql = 'SELECT searchtree, description, childs, childs_description
                FROM Gweb\TecdocBundle\Entity\Tecdoc301SearchTree searchtree
                JOIN searchtree.description description WITH description.sprachnr = :sprachnr
                LEFT JOIN searchtree.childs childs
                LEFT JOIN childs.description childs_description WITH childs_description.sprachnr = :sprachnr
                WHERE searchtree.nodeId = :nodeId
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('nodeId', $nodeId);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getOneOrNullResult();
    }
}
