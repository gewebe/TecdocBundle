<?php

namespace Gweb\TecdocBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Gweb\TecdocBundle\Entity\Tecdoc020Language;

/**
 * Entity repository for Language
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class LanguageRepository extends EntityRepository
{
    /**
     * Find language by iso 2 letter code
     * @param string $isocode
     * @return Tecdoc020Language|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIsocode(string $isocode): ?Tecdoc020Language
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['language'])
            ->from(Tecdoc020Language::class, 'language')
            ->where("language.isocode = :isocode")
            ->setParameter(':isocode', $isocode);

        // cache query
        return $qb->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true, 3600, Tecdoc020Language::class.$isocode)
            ->getOneOrNullResult();
    }
}
