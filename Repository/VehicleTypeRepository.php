<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc120VehicleType;

/**
 * Entity repository for VehicleType
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class VehicleTypeRepository extends TranslateEntityRepository
{
    /**
     * Find vehicle by TecDoc KTypNr
     * @param int $ktypnr
     * @return Tecdoc120VehicleType|null
     */
    public function findVehicle(int $ktypnr): ?Tecdoc120VehicleType
    {
        $dql = 'SELECT vehicle, 
                       vehicleDescription,
                       model,
                       modelDescription,
                       manufacturer,
                       manufacturerDescription
                FROM Gweb\TecdocBundle\Entity\Tecdoc120VehicleType vehicle
                JOIN vehicle.description vehicleDescription WITH vehicleDescription.sprachnr = :sprachnr
                JOIN vehicle.vehicleModel model
                JOIN model.description modelDescription WITH modelDescription.sprachnr = :sprachnr
                JOIN model.manufacturer manufacturer
                JOIN manufacturer.description manufacturerDescription WITH manufacturerDescription.sprachnr = :sprachnr
                WHERE vehicle.ktypnr = :ktypnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('ktypnr', $ktypnr);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getOneOrNullResult();
    }

    /**
     * @param int $kmodnr
     * @return Tecdoc120VehicleType[]
     */
    public function findByVehicleModel(int $kmodnr): array
    {
        $dql = 'SELECT vehicle, 
                       vehicleDescription
                FROM Gweb\TecdocBundle\Entity\Tecdoc120VehicleType vehicle
                JOIN vehicle.description vehicleDescription WITH vehicleDescription.sprachnr = :sprachnr
                WHERE vehicle.kmodnr = :kmodnr
                ORDER BY vehicle.sortnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('kmodnr', $kmodnr);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }
}
