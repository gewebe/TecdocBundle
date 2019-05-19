<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc110VehicleModel;

/**
 * Entity repository for Vehicle Model
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class VehicleModelRepository extends TranslateEntityRepository
{
    /**
     * Find models by manufacturer
     * @param int $hernr
     * @return Tecdoc110VehicleModel[]
     */
    public function findByManufacturer(int $hernr): array
    {
        $dql = 'SELECT model,
                       modelDescription
                FROM Gweb\TecdocBundle\Entity\Tecdoc110VehicleModel model
                JOIN model.description modelDescription WITH modelDescription.sprachnr = :sprachnr
                WHERE model.hernr = :hernr
                ORDER BY model.sortnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('hernr', $hernr);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }
}
