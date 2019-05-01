<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc100Manufacturer;

/**
 * Entity repository for Manufacturer
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ManufacturerRepository extends TranslateEntityRepository
{
    /**
     * Find all manufacturers
     * @return Tecdoc100Manufacturer[]
     */
    public function findAll(): array
    {
        $dql = 'SELECT manufacturer,
                       description
                FROM Gweb\TecdocBundle\Entity\Tecdoc100Manufacturer manufacturer
                JOIN manufacturer.description description WITH description.sprachnr = :sprachnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }
}
