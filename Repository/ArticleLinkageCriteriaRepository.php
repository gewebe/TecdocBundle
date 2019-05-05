<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;
use Gweb\TecdocBundle\Entity\Tecdoc410ArticleLinkageCriteria;

/**
 * Entity repository for ArticleLinkageCriteria
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleLinkageCriteriaRepository extends TranslateEntityRepository
{
    /**
     * Find article vehicle criteria
     * @param int $dlnr
     * @param string $artnr
     * @param int $genartnr
     * @param int $ktypnr
     * @return Tecdoc410ArticleLinkageCriteria[]
     */
    public function findByArticleVehicle(
        int $dlnr,
        string $artnr,
        int $genartnr,
        int $ktypnr
    ): array {
        return $this->findByArticleLinkage(
            $dlnr,
            $artnr,
            $genartnr,
            Tecdoc400ArticleLinkage::LINKAGE_VEHICLE,
            $ktypnr
        );
    }

    /**
     * Find article linkage criteria
     * @param int $dlnr
     * @param string $artnr
     * @param int $genartnr
     * @param int $vknzielart (2: KTypNr, 7: HerNr, 14: MotNr, 16: CVTypNr, 19: AxleTypNr)
     * @param int $vknzielnr
     * @return Tecdoc410ArticleLinkageCriteria[]
     */
    public function findByArticleLinkage(
        int $dlnr,
        string $artnr,
        int $genartnr,
        int $vknzielart,
        int $vknzielnr
    ): array {
        $dql = 'SELECT article,
                       criteria,
                       description
                FROM Gweb\TecdocBundle\Entity\Tecdoc410ArticleLinkageCriteria article
                JOIN article.criteria criteria
                JOIN criteria.description description WITH description.sprachnr = :sprachnr
                WHERE article.dlnr = :dlnr
                AND article.artnr = :artnr
                AND article.genartnr = :genartnr
                AND article.vknzielart = :vknzielart
                AND article.vknzielnr = :vknzielnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr)
            ->setParameter('artnr', $artnr)
            ->setParameter('genartnr', $genartnr)
            ->setParameter('vknzielart', $vknzielart)
            ->setParameter('vknzielnr', $vknzielnr)
            ->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }
}
