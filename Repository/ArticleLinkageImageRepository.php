<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;
use Gweb\TecdocBundle\Entity\Tecdoc432ArticleLinkageImage;

/**
 * Entity repository for ArticleLinkageImage
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleLinkageImageRepository extends TranslateEntityRepository
{
    /**
     * Find article vehicle image
     * @param int $dlnr
     * @param string $artnr
     * @param int $genartnr
     * @param int $ktypnr
     * @return Tecdoc432ArticleLinkageImage[]
     */
    public function findByArticleVehicle(
        int $dlnr,
        string $artnr,
        int $genartnr,
        int $ktypnr
    ): array {
        return $this->findByArticlelLinkage(
            $dlnr,
            $artnr,
            $genartnr,
            Tecdoc400ArticleLinkage::LINKAGE_VEHICLE,
            $ktypnr
        );
    }

    /**
     * Find article linkage image
     * @param int $dlnr
     * @param string $artnr
     * @param int $genartnr
     * @param int $vknzielart (2: KTypNr, 7: HerNr, 14: MotNr, 16: CVTypNr, 19: AxleTypNr)
     * @param int $vknzielnr
     * @return Tecdoc432ArticleLinkageImage[]
     */
    public function findByArticlelLinkage(
        int $dlnr,
        string $artnr,
        int $genartnr,
        int $vknzielart,
        int $vknzielnr
    ): array
    {
        $dql = 'SELECT article,
                       image,
                       documentType
                FROM Gweb\TecdocBundle\Entity\Tecdoc432ArticleLinkageImage article
                JOIN article.image image WITH image.sprachnr = :sprachnr OR image.sprachnr=255
                JOIN image.documentType documentType 
                WHERE article.dlnr = :dlnr
                AND article.artnr = :artnr
                AND article.genartnr = :genartnr
                AND article.vknzielart = :vknzielart
                AND article.vknzielnr = :vknzielnr
                ORDER BY article.sortnr ASC
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
