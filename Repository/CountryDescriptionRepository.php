<?php

namespace Gweb\TecdocBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Gweb\TecdocBundle\Entity\Tecdoc012CountryDescription;

/**
 * Entity repository for CountryDescription
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class CountryDescriptionRepository extends EntityRepository
{
    /**
     * Find county description
     * @param int $lbeznr
     * @param int $sprachnr
     * @return Tecdoc012CountryDescription|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findDescription(int $lbeznr, int $sprachnr):? Tecdoc012CountryDescription
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['description'])
          ->from(Tecdoc012CountryDescription::class, 'description')
          ->where("description.lbeznr = :lbeznr")
          ->andWhere("description.sprachnr = :sprachnr")
          ->setParameter(':lbeznr', $lbeznr)
          ->setParameter(':sprachnr', $sprachnr);

        // cache query
        return $qb->getQuery()
          ->useQueryCache(true)
          ->useResultCache(true, 3600, Tecdoc012CountryDescription::class . $lbeznr . $sprachnr)
          ->getOneOrNullResult();
    }
}
