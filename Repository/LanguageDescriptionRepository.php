<?php

namespace Gweb\TecdocBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Gweb\TecdocBundle\Entity\Tecdoc030LanguageDescription;

/**
 * Entity repository for LanguageDescription
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class LanguageDescriptionRepository extends EntityRepository
{
    /**
     * Find language description
     * @param int $beznr
     * @param int $sprachnr
     * @return Tecdoc030LanguageDescription|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findDescription(int $beznr, int $sprachnr):? Tecdoc030LanguageDescription
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['description'])
          ->from(Tecdoc030LanguageDescription::class, 'description')
          ->where("description.beznr = :beznr")
          ->andWhere("description.sprachnr = :sprachnr")
          ->setParameter(':beznr', $beznr)
          ->setParameter(':sprachnr', $sprachnr);

        // cache query
        return $qb->getQuery()
          ->useQueryCache(true)
          ->useResultCache(true, 3600, Tecdoc030LanguageDescription::class . $beznr . $sprachnr)
          ->getOneOrNullResult();
    }
}
