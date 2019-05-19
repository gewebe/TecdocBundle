<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc120VehicleType;
use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;

/**
 * Entity repository for ArticleLinkage
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleLinkageRepository extends TranslateEntityRepository
{
    /**
     * Find article vehicle
     * @param int $dlnr
     * @param string $artnr
     * @param int $genartnr
     * @return Tecdoc120VehicleType[]
     */
    public function findVehicleByArticle(
        int $dlnr,
        string $artnr,
        int $genartnr
    ): array {
        $dql = 'SELECT vehicle, 
                       vehicleDescription,
                       model,
                       modelDescription,
                       manufacturer,
                       manufacturerDescription
                FROM Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage articleLinkage
                JOIN Gweb\TecdocBundle\Entity\Tecdoc120VehicleType vehicle WITH vehicle.ktypnr = articleLinkage.vknzielnr
                JOIN vehicle.description vehicleDescription WITH vehicleDescription.sprachnr = :sprachnr
                JOIN vehicle.vehicleModel model
                JOIN model.description modelDescription WITH modelDescription.sprachnr = :sprachnr
                JOIN model.manufacturer manufacturer
                JOIN manufacturer.description manufacturerDescription WITH manufacturerDescription.sprachnr = :sprachnr
                WHERE articleLinkage.dlnr = :dlnr
                AND articleLinkage.artnr = :artnr
                AND articleLinkage.genartnr = :genartnr
                AND articleLinkage.vknzielart = 2
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr);
        $query->setParameter('artnr', $artnr);
        $query->setParameter('genartnr', $genartnr);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }

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
