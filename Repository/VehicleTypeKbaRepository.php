<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc121VehicleTypeKba;

/**
 * Entity repository for VehicleTypeKba
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class VehicleTypeKbaRepository extends TranslateEntityRepository
{
    /**
     * Find vehicle by German KBA number
     * @param string $kba
     * @return Tecdoc121VehicleTypeKba[]
     */
    public function findByKba(string $kba): array
    {
        $dql = 'SELECT vehicleKba, 
                       vehicle,
                       vehicleDescription,
                       model,
                       modelDescription,
                       manufacturer,
                       manufacturerDescription
                FROM Gweb\TecdocBundle\Entity\Tecdoc121VehicleTypeKba vehicleKba
                JOIN vehicleKba.vehicleType vehicle
                JOIN vehicle.description vehicleDescription WITH vehicleDescription.sprachnr = :sprachnr
                JOIN vehicle.vehicleModel model
                JOIN model.description modelDescription WITH modelDescription.sprachnr = :sprachnr
                JOIN model.manufacturer manufacturer
                JOIN manufacturer.description manufacturerDescription WITH manufacturerDescription.sprachnr = :sprachnr
                WHERE vehicleKba.kbanr = :kbanr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('kbanr', $kba);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }
}
