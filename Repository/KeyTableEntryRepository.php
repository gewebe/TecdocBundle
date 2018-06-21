<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc052KeyTableEntry;
use Doctrine\ORM\EntityRepository;

/**
 * Entity repository for KeyTableEntry
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class KeyTableEntryRepository extends EntityRepository
{
    /**
     * Find key table entry
     * @param int $tabnr
     * @param string $key
     * @return Tecdoc052KeyTableEntry|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findKeyEntry(int $tabnr, string $key): ?Tecdoc052KeyTableEntry
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['keyEntry'])
            ->from(Tecdoc052KeyTableEntry::class, 'keyEntry')
            ->join('keyEntry.keyTable', 'keyTable')
            ->where("keyEntry.tabnr = :tabnr AND keyTable.tabtyp = 'N' AND keyEntry.key = :key_number")
            ->orWhere("keyEntry.tabnr = :tabnr AND keyTable.tabtyp = 'A' AND keyEntry.key = :key_string")
            ->setParameter(':tabnr', $tabnr)
            // integer stored with leading zeros
            ->setParameter(':key_number', sprintf('%03d', $key))
            ->setParameter(':key_string', $key);

        // cache query
        return $qb->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true, 3600, Tecdoc052KeyTableEntry::class.$tabnr.$key)
            ->getOneOrNullResult();
    }
}
