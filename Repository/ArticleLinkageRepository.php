<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;
use Doctrine\ORM\EntityRepository;

/**
 * Entity repository for ArticleLinkage
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleLinkageRepository extends EntityRepository
{
    /**
     * Find article linkage
     * @param int $dlnr
     * @param string $artnr
     * @param int $genartnr
     * @param int $vknzielart (2: KTypNr, 7: HerNr, 14: MotNr, 16: CVTypNr, 19: AxleTypNr)
     * @return Tecdoc400ArticleLinkage[]
     */
    public function findByArticle(
        int $dlnr,
        string $artnr,
        int $genartnr,
        int $vknzielart = null
    ): array {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['linkage'])
            ->from(Tecdoc400ArticleLinkage::class, 'linkage')
            ->where('linkage.dlnr = :dlnr AND linkage.artnr = :artnr')
            ->andWhere('linkage.genartnr = :genartnr')
            ->setParameter(':dlnr', $dlnr)
            ->setParameter(':artnr', $artnr)
            ->setParameter(':genartnr', $genartnr);

        if ($vknzielart !== null) {
            $qb->andWhere('linkage.vknzielart = :vknzielart')
                ->setParameter(':vknzielart', $vknzielart);
        }

        return $qb->getQuery()->getResult();
    }

}
